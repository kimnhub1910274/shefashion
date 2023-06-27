<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

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
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        $result = DB::table('tbl_admin')->where('admin_email', $admin_email)
        ->where('admin_password', $admin_password)->first();

        if ($result) {
           Session::put('admin_name', $result->admin_name);
           Session::put('admin_id', $result->admin_id);
            return Redirect::to('/dashboard');

        } else {
            $request->session()->put('message', 'Vui long dang nhap lai!!');
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

}
