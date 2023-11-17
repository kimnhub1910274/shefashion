<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use App\Models\Admin;
use App\Models\Roles;
use Illuminate\Support\Facades\Redirect;
class UserController extends Controller
{
    public function index(){
        $admin = Admin::with('roles')->orderBy('admin_id', 'DESC')->paginate(5);
        return view('admin.users.all_permission')->with(compact('admin'));
    }
    public function add_user(){
        return view('admin.users.add_user');
    }
    public function assign_roles(Request $request){
        $data = $request->all();
        $user = Admin::where('admin_email', $data['admin_email'])->first();
        if(!$user){
            return Redirect::back();
        }else{
            $user->roles()->detach();
        }
        if($request['admin_role']){
            $user->roles()->attach(Roles::where('role_name', 'admin')->first());
        }
        if($request['editor_role']){
            $user->roles()->attach(Roles::where('role_name', 'editor')->first());
        }
        if($request['censor_role']){
            $user->roles()->attach(Roles::where('role_name', 'censor')->first());
        }
        return redirect()->back();
    }
    public function store_user(Request $request){
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_password = $data['admin_password'];
        $admin->save();
        $admin->roles()->attach(Roles::where('role_name', 'user')->first());
        Session::put('message', 'Thêm thành công');

        return Redirect::to('all-permission');

    }
}
