<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use App\Models\Roles;
use App\Http\Controllers\Redirect;
use Auth;
session_start();

class AuthController extends Controller
{
    public function register_admin(){
        return view('admin.auth.register');
    }
    public function register(Request $request){
        $this->validation($request);
        $data = $request->all();

        $admin = new Admin();
        $admin->admin_email = $data['admin_email'];
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->save();
        return Redirect('/register-admin')->with('message', 'Đăng ký thành công');
    }
    public function validation($request){
        return $this->validate($request, [
            'admin_name' =>'required|max:255',
            'admin_email' =>'required|email|max:255',
            'admin_phone' =>'required|max:255',
            'admin_password' =>'required|max:255',
        ]);
    }
    public function login_admin(){
        return view('admin.auth.login');

    }
    public function login(Request $request){
        $this->validate($request, [
            'admin_email' =>'required|max:255',
            'admin_password' =>'required|max:255',
        ]);
        //$data = $request->all();
        if(Auth::attempt(['admin_email' => $request->admin_email, 'admin_password' => $request->admin_password]))
        {
            return redirect('/dashboard');
        }else{
            return redirect('/login-admin')->with('message', 'Đăng nhập không thành công!');

        }

    }
    public function logout_admin(Request $request)
    {
        Auth::logout();
     return Redirect('/admin');
    }
}
