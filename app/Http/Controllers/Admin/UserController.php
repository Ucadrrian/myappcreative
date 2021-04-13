<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('isadmin');
    }
    
    public function getUsers($status)
    {
        if($status == 'all'):
            $users=User::orderBy('id','Desc')->paginate(20);
        else:
            $users =User::where('status', $status)->orderBy('id','Desc')->paginate(20);
        endif;
        $data=['users'=>$users];
        return view('admin.users.home',$data);
     
    }

    public function getUserEdit($id){
        $u = User::findOrFail($id);
        $data = ['u' => $u];
        return view('admin.users.user_edit',$data);
    }

    public function getUserBanned($id){
        $u = User::findOrFail($id);
        if($u->status == "100"):
            $u->status = "1";
            $msg="Usuario activado nuevamente";
        else:
            $u->status = "100";
            $msg="Usuario suspendido con éxito";
        endif;

        if($u->save()):
            return back()->with('message',$msg)->with('typealert','success');
        endif;
    }

    public function getUserPermissions($id){
        $u = User::findOrFail($id);
        $data = ['u' => $u];
        return view('admin.users.user_permissions',$data);
    }

    public function postUserPermissions(Request $request, $id)
    {
     $u = User::findOrFail($id);
     $permissions=[];

    }

    
}
