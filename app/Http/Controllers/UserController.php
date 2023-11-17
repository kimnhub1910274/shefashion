<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use App\Models\Admin;
use App\Models\Roles;
use Auth;
use Illuminate\Support\Facades\Redirect;
class UserController extends Controller
{
    public function index(){
        $admin = Admin::with('roles')->orderBy('admin_id', 'DESC')->paginate(5);
        return view('admin.users.all_permission')->with(compact('admin'));
    }
    public function add_permission(){
        return view('admin.users.add_permission');
    }
    public function assign_roles(Request $request){
        if(Auth::id() == $request->admin_id){
            return Redirect()->back()->with('message', 'Không thể phân quyền cho Người quản trị!');

        }
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
    public function store_users(Request $request){
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_password = $data['admin_password'];
        $admin->save();
        $admin->roles()->attach(Roles::where('role_name', 'censor')->first());
        Session::put('message', 'Thêm thành công');

        return Redirect::to('all-permission');

    }
    public function delete_roles($admin_id){
        if(Auth::id() == $admin_id){
            return Redirect()->back()->with('message', 'Không thể xóa khi đang đăng nhập!');
        }
            $admin = Admin::find($admin_id);
            if($admin){
                $admin->roles()->detach();
                $admin->delete();
            }
            return Redirect()->back()->with('message', 'Xóa thành công');

    }
}
