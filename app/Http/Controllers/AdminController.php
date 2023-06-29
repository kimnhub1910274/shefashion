<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Socialite;
use App\Models\Login;
use App\Models\Social;
session_start();
class AdminController extends Controller
{
    public function index()
    {
       return view('admin_login');
    }

    public function show_dashboard()
    {
       return view('admin.dashboard');
    }
    public function dashboard(Request $request)
    {
        $data = $request->all();
        $admin_email = $data['admin_email'];
        $admin_password = md5($data['admin_password']);
        $login = Login::where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        $login_count = $login->count();
        if($login_count){
            Session::put('admin_name', $login->admin_name);
            Session::put('admin_id', $login->admin_id);
            return Redirect::to('/dashboard');
        }else{
            Session::put('message', 'Vui long dang nhap lai!!');
            return Redirect::to('/admin');
        }

    }
    public function logout(Request $request)
    {
        Session::put('admin_name', null);
        Session::put('admin_id', null);
     return Redirect::to('/admin');
    }
    public function admin_search (Request $request)
    {
        $key = $request->key_word;
        $cate_product = DB::table('tbl_cate_pro')->where('cate_status', '1')->orderby('cate_id', 'desc')->get();
        $customer = DB::table('tbl_customers')->orderby('customer_id', 'desc')->get();
        $search_product = DB::table('tbl_product')->where('product_name', 'like', '%'.$key.'%')->get();
        $search_customer = DB::table('tbl_customers')->where('customer_name', 'like', '%'.$key.'%')->get();
        return view('admin.search')->with('category', $cate_product)
        ->with('search_product', $search_product)->with('search_customer', $search_customer);

    }
    public function search_customer (Request $request)
    {
        $key = $request->key_word;
        $customer = DB::table('tbl_customers')->orderby('customer_id', 'desc')->get();
        $search_customer = DB::table('tbl_customers')->where('customer_name', 'like', '%'.$key.'%')->get();
        return view('admin.search_customer')->with('search_customer', $search_customer);

    }
    public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }
    public function callback_facebook(){
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider', 'facebook')->where('provider_user_id', $provider->getId())->first();
        if($account){
            $account_name = Login::where('admin_id', $account->user)->first();
            Session::put('admin_name', $account_name->admin_name);
            Session::put('admin_id', $account_name->admin_id);
            return Redirect::to('/dashboard')->with('message', 'Đăng nhập Admin thành công');

        }else{
            $us = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' =>'facebook'
            ]);

            $orang = Login::where('admin_email', $provider->getEmail())->first();
            if(!$orang){
                $orang = Login::create([
                    'admin_name' => $provider->getName(),
                    'admin_email' => $provider->getEmail(),
                    'admin_password' => '',
                    'admin_phone' => '',
                ]);
            }
            $us->login()->associate($orang);
            $us->save();

            $account_name = Login::where('admin_id', $account->user)->first();
            Session::put('admin_name', $account_name->admin_name);
            Session::put('admin_id', $account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        }
    }

}