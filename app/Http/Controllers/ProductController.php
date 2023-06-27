<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

session_start();

class ProductController extends Controller
{
    public function add_product()
    {
        $cate_product = DB::table('tbl_cate_pro')->orderby('cate_id', 'desc')->get();
        return view('admin.add_product')->with('cate_product', $cate_product);
    }

    public function list_product()
    {
        $list_product = DB::table('tbl_product')
        ->join('tbl_cate_pro', 'tbl_cate_pro.cate_id', '=', 'tbl_product.category_id')
        ->where('cate_status', 1)
        ->orderby('tbl_product.product_id')->get();

        $manager = view('admin.list_product')->with('list_product', $list_product);

        return view('admin_dashboard')->with('admin.list_category_product', $manager);
    }

    public function save_product(Request $request)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_image'] = $request->product_image;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['category_id'] = $request->product_cate;
        $data['product_status'] = $request->product_status;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_sold'] = $request->product_sold;

        $get_img = $request->file('product_image');

        if ($get_img) {
            $get_name_img = $get_img->getClientOriginalName();
            $name_img = current(explode('.', $get_name_img));
            $new_img = $name_img.rand(0,99).'.'.$get_img->getClientOriginalExtension();
            $get_img->move('public/uploads/product', $new_img);
            $data['product_image'] = $new_img;
            DB::table('tbl_product')->insert($data);
            Session::put('message', 'Thêm thành công');
            return Redirect::to('add-product');
        }
        $data['product_image'] = '';
        DB::table('tbl_product')->insert($data);
        Session::put('message', 'Thêm thành công');
        return Redirect::to('add-product');

        DB::table('tbl_product')->insert($data);
        Session::put('message', 'Thêm thành công');
        return Redirect::to('add-product');
    }

    public function on_pro($product_id)
    {

        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status'=>0]);
        Session::put('message', 'Không hiện sản phẩm');
        return Redirect::to('list-product');
    }

    public function off_pro($product_id)
    {
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status'=>1]);
        Session::put('message', 'Hiện sản phẩm');
        return Redirect::to('list-product');
    }
    public function edit_product($product_id)
    {
        $cate_product = DB::table('tbl_cate_pro')->orderby('cate_id', 'desc')->get();
        $edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product', $edit_product)
        ->with('cate_product', $cate_product);

        return view('admin_dashboard')->with('admin.edit_product', $manager_product);
    }
    public function update_product(Request $request, $product_id){
        $data = array();
        $data['product_name'] = $request->product_name;
        //$data['product_image'] = $request->product_image;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['category_id'] = $request->product_cate;
        $data['product_status'] = $request->product_status;
        $data['product_quantity'] = $request->product_quantity;

        $get_img = $request->file('product_image');
        if ($get_img) {
            $get_name_img = $get_img->getClientOriginalName();
            $name_img = current(explode('.', $get_name_img));
            $new_img = $name_img.rand(0,99).'.'.$get_img->getClientOriginalExtension();
            $get_img->move('public/uploads/product', $new_img);
            $data['product_image'] = $new_img;
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            Session::put('message', 'Cập nhật sản phẩm không thành công');
            return Redirect::to('list-product');
        }
        DB::table('tbl_product')->where('product_id', $product_id)->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công');
        return Redirect::to('list-product');


    }
    public function delete_product($product_id)
    {

        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        Session::put('message', 'Xóa sản phẩm thành công');
        return Redirect::to('list-product');

    }
    //end admin
    public function product_detail(Request $request, $product_id)
    {
        $cate_product = DB::table('tbl_cate_pro')->where('cate_status', '1')->orderby('cate_id', 'desc')->get();
        $detail_product = DB::table('tbl_product')
        ->join('tbl_cate_pro', 'tbl_cate_pro.cate_id', '=', 'tbl_product.category_id')
        ->where('tbl_product.product_id', $product_id)->get();
        foreach ($detail_product as $key => $val)
        {
            $category_id = $val->category_id;
            $meta_desc = $val->product_desc;
            $meta_keywords = $val->product_name;
            $meta_title = $val->product_name;
            $meta_url = $request->url();

        }
        $related_product = DB::table('tbl_product')
            ->join('tbl_cate_pro', 'tbl_cate_pro.cate_id', '=', 'tbl_product.category_id')
            ->where('tbl_cate_pro.cate_id', $category_id)->whereNotIn('tbl_product.product_id', [$product_id])->get();

        return view('pages.product.product_detail')->with('category', $cate_product)
        ->with('product_details', $detail_product)->with('related', $related_product)
        ->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('meta_url', $meta_url);

    }
}
