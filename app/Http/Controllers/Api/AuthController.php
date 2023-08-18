<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use JWTAuth;
use Illuminate\Support\Facades\Validator;
use DB;
use JWTAuthException;
use Illuminate\Support\Facades\Storage;
use Mail;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        // dd($user->findOrfail(1));
    }

    public function login(Request $request)
    {
        
       if(!($request->username))
        {            
            return response()->json(['success'=>0,'message'=>'username is required'],200);
        }
        if(!($request->password)){
            return response()->json(['success'=>0,'message'=>'password is required'],200);
        }
        
        $number = User::where('number',$request->get('username'))->first();
        $email = User::where('email', $request->get('username'))->first();
        if($number || $email)
        {
                  
            $input = ['email'=>$number? $number->email : $email->email, 'password'=> $request->password];
            $jwt_token = null;
            $token = JWTAuth::attempt($input);

            if (!$jwt_token = JWTAuth::attempt($input)) {

                

                return response()->json([
        
                    'success' => false,
        
                    'message' => 'Invalid Email or Password',
        
        
        
                ], 200);
            }else{
                $user= JWTAuth::user();
                $user->otp = rand(0,999999);
                $user->otp_verify=0;
                $user->save();
                return response()->json([

                   'success' => true,

                    'message' => 'User successfully Login to the app',

                    'userData' => $user,
                    
                    'Token' => $token,
                    //'frenchise'=> $frenchise,
                ], 200);
            }

        }
        else{
            return response()->json(['success'=>0,'message'=>'email or password is wrong'],200);
        }
    }

    public function register(Request $request){
       

        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'number' => 'required',
            'password' => 'required',
        ];
    
        // Validation messages
        $messages = [
            'email.unique' => 'Email already in use.',
        ];
       
       
       
        $validator = Validator::make($request->all(), $rules, $messages);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => 0,
                'message' => $validator->errors()->first(),
            ], 200);
        }

        
        try{

         $reg = $this->user->create($request->only(['first_name','last_name','email','number']) + 
         [
            'show_password' => $request->get('password'),
            'password' => bcrypt($request->get('password')),
            'otp' => rand(100000,999999),
            'otp_verify' => 0,
        ]); 

        return response()->json(['success' => 1, 'message' => 'User successfully Registered to the app', 'userData' => $reg]); 
     } catch (\Illuminate\Database\QueryException $e) 
     {
         $errorCode = $e->errorInfo[1];
         if($errorCode == '1062'){
            return response()->json(['success' => 0, 'message' => 'Duplicate Entry Exception!. User Already Registered'], 200);
        }
      }  
    }

    public function otpVerify(Request $request){
        //dd("krishnaji");
        \Config::set('jwt.user', "App\User");
        \Config::set('auth.providers.users.model', \App\User::class);
    
        $user = JWTAuth::user();
        

        if($user->otp == $request->otp){

            $user->otp = null;
            $user->otp_verify = 1;
            $user->save();
            return response()->json(['success' => 1, 'message' => 'otp veryfied successfully', 'user'=>$user]);
        }else{
            return response()->json(['success' => 0, 'message' => 'otp is wrong! please try again!']);
        }  
    }

    public function resendOtp(Request $request){
        dd("true");
        $request->validate([
            'email' => 'required|email',
        ]);
        
    }

    public function changepassword(Request $request){
        // $user = Auth::user();
        $user = JWTAuth::user();
        // dd($user);
      
        if(Hash::check($request->oldpassword, $user->password)){
           
            $user->password = Hash::make($request->password);
            $user->show_password = $request->password;
            $user->save();
            return response()->json(['success' => 1,'message'=>'password changed successfully']);
        }else{
            return response()->json(['success' => 0,'message'=>'old password not match']);
        }
        
    }

    public function getUser(Request $request){
       
        $user = User::findOrfail(JWTAuth::user()->id);
        // $user->image = !empty($user->image) ? url('/storage/uploads/users/Medium').'/'.$user->image : '';
    
        if ($user) {
         return response()->json(['status' => 1, 'message' => 'User details fetched successfully.', 'data' => $user ], 200); 
        } else{
         return response()->json(['status' => 0, 'message' => 'No data found!', 'data' => '' ], 200);  
       }  
    }

    public function update_user(Request $request){
        $param = $request->all();
        $user = User::where('id',JWTAuth::user()->id)->update($param);
 
       if ($user) {
          return response()->json(['status' => 1, 'message' => 'User details Updated successfully.', 'data' =>  User::findOrfail(JWTAuth::user()->id) ], 200); 
        } else{
          return response()->json(['status' => 0, 'message' => 'No data found!', 'data' => '' ], 200);  
       }
   }


}
