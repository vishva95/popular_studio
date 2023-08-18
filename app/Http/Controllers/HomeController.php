<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use File;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('home');
    }
    public function changeMultipleStatus(Request $request)
    {
        $table_name = $request->get('table_name');
        $param = $request->get('param');
        $id_array = explode(',', $request->get('id'));
        try {

            if ($param == 0) {
                foreach ($id_array as $id) {
                    // dd($id);
                    DB::table($table_name)->where('id', $id)
                    ->update([
                        'status' => 0,
                    ]);
                }
            } elseif ($param == 1) {
                foreach ($id_array as $id) {
                    DB::table($table_name)->where('id', $id)
                    ->update([
                        'status' => 1,
                    ]);
                }
            }


            $res['status'] = 'Success';
            $res['message'] = 'Status Change successfully';
        } catch (\Exception $ex) {
            $res['status'] = 'Error';
            $res['message'] = 'Something went wrong.';
        }
        return response()->json($res);
    }
    public function deleteMultiple(Request $request)
    {
        $table_name = $request->get('table_name');
        $id_array = explode(',', $request->get('id'));
        try {
            if ($request->has('folder_name')) {
                foreach ($id_array as $id) {
                    $records = DB::table($table_name)->where('id', $id)->first();
                    if ($records->image != '' && $records->image) {
                        try {
                            ImageHelper::deleteModuleMultipleImage($records->image, storage_path() . "/app/public/uploads/image/");
                        } catch (\Exception $ex) {
                        }
                    }
                    
                }
            } else {


                DB::table($table_name)->whereIn('id', $id_array)->delete();
                
            }
            $res['status'] = 'Success';
            $res['message'] = 'Deleted successfully';
        } catch (\Exception $ex) {

            $res['status'] = 'Error';
            $res['message'] = $ex->getMessage();
        }
        return response()->json($res);
    }
    public function changeOrder(Request $request) {
        if ($request->ajax()) {
            $table_name = $request->get('table_name');
            $ids = $request->get('row');
            foreach ($ids as $key => $value) {
             DB::table($table_name)->where('id', $value)
             ->update([
                'order' => ($key),
            ]);
         }
     }
     $res['status'] = 'Success';
     $res['message'] = 'Order Change successfully';
     return response()->json($res);
 }

}
