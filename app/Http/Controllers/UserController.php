<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use App\Models\Roles;
use App\Http\Controllers\Redirect;

class UserController extends Controller
{
    public function index(){
        $admin = Admin::with('roles')->orderBy('admin_id', 'DESC')->paginate(5);
        return view('admin.users.all_user')->with(compact('admin'));
    }
    public function add_user(){
        return view('admin.users.add_user');
    }
    public function assign_roles(){
        $data = $request->all();
        $user = Admin::where('admin_email', $data['admin_email'])->first();
        $user->roles()->detach();
        if($request['admin_role']){
            $user->roles()->attach(Roles::where('role_name', 'admin')->first())
        }
        if($request['admin2_role']){
            $user->roles()->attach(Roles::where('role_name', 'admin2')->first())
        }
        if($request['admin3_role']){
            $user->roles()->attach(Roles::where('role_name', 'admin3')->first())
        }
        return redirect()->back();
    }

}
