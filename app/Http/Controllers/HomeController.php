<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Mail;
use App\Mail\Gmail;

session_start();

class HomeController extends Controller
{

    public function index(Request $request)
    {
        //Seo
        $meta_desc = "Chuyên bán quần, áo nữ. Phong cách thời trang của các cô gái sành điệu.
          Update mẫu mới hàng tuần. Kiểu: Basic, Gợi cảm, Thanh lịch, Năng động.";
        $meta_keywords = "quan ao nu, vay nu, ao, jumpsuit";
        $meta_title = "Phong cách hiện đại, nữ tính. Chất liệu cao cấp";
        $meta_url = $request->url();

        $cate_product = DB::table('tbl_cate_pro')->where('cate_status', '1')->orderby('cate_id', 'desc')->get();
        $list_product = DB::table('tbl_product')->where('product_status', '1')->
        orderby('product_id', 'desc')->limit(4)->get();

        return view('pages.home')->with('category', $cate_product)->with('list_product', $list_product)
        ->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('meta_url', $meta_url);
        //return view('pages.home')->with(compact('cate_product', 'list_product', 'meta_desc', 'meta_keywords', 'meta_title', 'meta_url'));

    }
    public function product(Request $request)
    {
        $cate_product = DB::table('tbl_cate_pro')->where('cate_status', '1')->orderby('cate_id', 'desc')->get();
        $list_product = DB::table('tbl_product')->where('product_status', '1')->orderby('product_id', 'desc')->get();
       if(isset($_GET['sort_by'])){
        $sort_by = $_GET['sort_by'];
        if($sort_by == 'increase'){
            $list_product =  DB::table('tbl_product')->orderBy('product_price', 'ASC')->paginate(6)
            ->appends(request()->query());
        }elseif($sort_by == 'reduce'){
            $list_product =  DB::table('tbl_product')
           ->orderBy('product_price', 'DESC')->paginate(6)
            ->appends(request()->query());
        }elseif($sort_by == 'a_z'){
            $list_product =  DB::table('tbl_product')
            ->orderBy('product_name', 'ASC')->paginate(6)
            ->appends(request()->query());
        }elseif($sort_by == 'z_a'){
            $list_product =  DB::table('tbl_product')
            ->orderBy('product_name', 'DESC')->paginate(6)
            ->appends(request()->query());
        }
    }else{
        $list_product = DB::table('tbl_product')->where('product_status', '1')->orderby('product_id', 'desc')->get();

    }
        foreach ($list_product as $key => $val)
        {

            $meta_desc = $val->product_desc;
            $meta_keywords = $val->product_name;
            $meta_title = $val->product_name;
            $meta_url = $request->url();

        }

        return view('pages.product')->with('category', $cate_product)->with('list_product',
         $list_product)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)->with('meta_url', $meta_url);
    }
    public function login(Request $request)
    {
        $username = $request->username;
        $password = md5($request->password);

        $result = DB::table('users')->where('username', $username)
        ->where('password', $password)->first();

        if ($result) {
            session()->regenerate();
        Session::put('name', $result->name);
        Session::put('id', $result->id);
            return Redirect::to('/checkout');

    } else {
        $request->session()->put('message', 'Vui long dang nhap lai!!');
        return redirect()->back();
        }
    }
    public function logout(Request $request)
    {
        Session::put('name', null);
        Session::put('id', null);
    return redirect()->back();
    }
    public function search (Request $request)
    {
        $key = $request->key_word;
        $cate_product = DB::table('tbl_cate_pro')->where('cate_status', '1')->orderby('cate_id', 'desc')->get();
        $search_product = DB::table('tbl_product')->where('product_name', 'like', '%'.$key.'%')->get();
        return view('pages.product.search')->with('category', $cate_product)->with('search_product', $search_product);

    }
    public function send_mail(){

            $to_name = "SheFashion";
            $to_email = "lethikimnhuhb@gmail.com";

            $data = array("name"=>"Mail từ tải khoản khách hàng", "body"=>"Mail về vấn đề đơn hàng");
            Mail::send('pages.mail.send_mail', $data, function($message) use ($to_name, $to_email){
                $message->to($to_email)->subject('Thư gửi từ SheFashion');
                $message->from($to_email, $to_name);
            });

    }


}
