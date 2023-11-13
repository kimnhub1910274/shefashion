<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Rules\Roles;
use Auth;
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
        $arr = [
            'admin_name' => $request->admin_name,
            'admin_password' => $request->admin_password,
        ];
        if ($request->remember == trans('remember.Remember Me')) {
            $remember = true;
        } else {
            $remember = false;
        }
        //kiểm tra trường remember có được chọn hay không

        if (Auth::guard('administrators')->attempt($arr)) {

            dd('đăng nhập thành công');
            //..code tùy chọn
            //đăng nhập thành công thì hiển thị thông báo đăng nhập thành công
        } else {

            dd('tài khoản và mật khẩu chưa chính xác');
            //...code tùy chọn
            //đăng nhập thất bại hiển thị đăng nhập thất bại
        }
    }

}
