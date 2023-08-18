<?php



namespace App\Http\Controllers;

use App\User;
use Session;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;
use DB;
use Auth;

class UserController extends Controller
{
    public function __construct(User $s)
    {
        $this->view = 'user';
        $this->route = 'user';
        $this->viewName = 'User';
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $query = User::latest();
            return Datatables::of($query)

            ->addColumn('role', function ($row) {

                if ($row['role'] == 1)
                {
                    $btn = 'Admin';
                }
                else
                {
                    $btn = 'Employee';
                }

                return $btn;


            })

            ->addColumn('singlecheckbox', function ($row) {
                if($row->id == 1){
                    $schk = 'Cannot Change';
                }else{
                 $schk = view('layout.singlecheckbox')->with(['id' => $row->id , 'status'=>$row->status])->render();
             }
             return $schk;

         })

            ->addColumn('action', function ($row) {
                if($row->id == 1){
                    $btn = 'Cannot Change';
                }else{
                 $btn = view('layout.actionbtnpermission')->with(['id' => $row->id, 'route' => 'user'])->render();
             }
             return $btn;

         })

            ->setRowClass(function () {
                return 'row-move';
            })
            ->setRowId(function ($row) {
                return 'row-' . $row->id;
            })
            ->rawColumns(['action','role','singlecheckbox'])
            ->make(true);

        }

        return view('user.index');
    }

    public function create()
    {

        $data['url'] = route($this->route . '.store');
        $data['title'] = 'Add User';
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;

        return view('general.add_form')->with($data);

    }

    public function store(Request $request)

    {
        $param = $request->all();
        if($request->password)
        {
            $param['show_password'] = $request->password;
            $param['password'] = bcrypt($request->password);
        }

        $user = User::create($param);


        if ($user){
            return response()->json(['status'=>'success']);
        }else{
            return response()->json(['status'=>'error']);
        }
    }

    public function edit($id)
    {

        $data['title'] = 'Edit User';
        $data['edit'] = User::findOrFail($id);
        $data['url'] = route($this->route . '.update', [$this->view => $id]);
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;

        return view('general.edit_form', compact('data'));
    }

    public function update(Request $request, $id)
    {

        $param = $request->all();

        unset($param['_token'], $param['_method']);
        if($request->password)
        {
            $param['show_password'] = $request->password;
            $param['password'] = bcrypt($request->password);
        }else{
            unset($param['password']);
        }
        $user = User::findOrFail($id);
        $user->update($param);

        if ($user){
            return response()->json(['status'=>'success']);
        }else{
            return response()->json(['status'=>'error']);
        }

    }

}
