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

    public function postUserPermissions(Request $request, $id){
        $u = User::findOrFail($id);
        $permissions=[
            'dashboard'=>$request->input('dashboard'),

            'comics'=>$request->input('comics'),
            'comic_add'=>$request->input('comic_add'),
            'comic_edit'=>$request->input('comic_edit'),
            'comic_delete'=>$request->input('comic_delete'),
            'comic_gallery_add'=>$request->input('comic_gallery_add'),
            'comic_gallery_delete'=>$request->input('comic_gallery_delete'),

            'categories'=>$request->input('categories'),
            'categories_add'=>$request->input('categories_add'),
            'categories_edit'=>$request->input('categories_edit'),
            // 'categories_delete'=>$request->input('categories_delete'),
            'user_list'=>$request->input('user_list'),
            'user_edit'=>$request->input('user_edit'),
            'user_banned'=>$request->input('user_banned'),
            'user_permissions'=>$request->input('user_permissions')
        ];

        $permissions = json_encode($permissions);
        $u->permissions = $permissions;
        if($u->save()):
            return back()->with('message','Los permisos del usuario fueron actualizados con éxito')->with('typealert','success');
        endif;
    }

    
}
