<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Cart;
session_start();


class CartController extends Controller
{
    public function add_cart_ajax(Request $request){
        $data = $request->all();
        //print_r($data);
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],

            );
            Session::put('cart',$cart);
        }
        Session::save();
    }
    public function save_cart(Request $request)
    {
        $product_id = $request->product_id_hidden;
        $quantity = $request->quantity;
        $product_info = DB::table('tbl_product')->where('product_id', $product_id)->first();

        $cate_product = DB::table('tbl_cate_pro')->where('cate_status', '1')->orderby('cate_id', 'desc')->get();

        $data['id'] = $product_info->product_id;
        $data['quantity'] = $quantity + 1;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['product_quantity'] = $product_info->product_quantity;
        $data['attributes']['image'] = $product_info->product_image;

        Cart::add($data);
        return Redirect::to('/');
    }
    public function save_cartt(Request $request)
    {
        $product_id = $request->product_id_hidden;
        $quantity = $request->quantity;
        $product_info = DB::table('tbl_product')->where('product_id', $product_id)->first();

        $cate_product = DB::table('tbl_cate_pro')->where('cate_status', '1')->orderby('cate_id', 'desc')->get();

        $data['id'] = $product_info->product_id;
        $data['quantity'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['product_quantity'] = $product_info->product_quantity;
        $data['attributes']['image'] = $product_info->product_image;
        Cart::add($data);
        return Redirect::to('/');
    }

    public function cart(Request $request)
    {
        $cate_product = DB::table('tbl_cate_pro')->where('cate_status', '1')->orderby('cate_id','desc')->get();
            $meta_desc = $request->product_desc;
            $meta_keywords = $request->product_name;
            $meta_title = $request->product_name;
            $meta_url = $request->url();

        return view('pages.cart.cart')->with('category', $cate_product)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)->with('meta_url', $meta_url);


    }

    public function delete_to_cart($id)
    {
        Cart::remove($id);
        return Redirect::to('/show-cart');
    }

    public function increase_to_cart(Request $request)
    {
        $cart_id = $request->cart_id;
        Cart::update($cart_id, array(
            'quantity' => +1,
        ));
        return Redirect::to('/show-cart');

    }
    public function reduce_to_cart(Request $request)
    {
        $cart_id = $request->cart_id;
        Cart::update($cart_id, array(
            'quantity' => -1,
          ));
        return Redirect::to('/show-cart');

    }


}
