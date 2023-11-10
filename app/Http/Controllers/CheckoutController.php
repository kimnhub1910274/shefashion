<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Cart;
session_start();
use App\Models\Ship;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Customer;
use Carbon\Carbon;
use Mail;
use App\Mail\Gmail;
class CheckoutController extends Controller
{
    public function login_checkout()
    {
        $cate_product = DB::table('tbl_cate_pro')->where('cate_status', '1')->orderby('cate_id', 'desc')->get();
        return view('pages.checkout.login')->with('category', $cate_product);
    }
    public function sign_up()
    {
        $cate_product = DB::table('tbl_cate_pro')->where('cate_status', '1')->orderby('cate_id', 'desc')->get();
        return view('pages.checkout.sign_up')->with('category', $cate_product);
    }
    public function add_customer(Request $request)
    {
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_address'] = $request->customer_address;
        $data['customer_password'] = md5($request->customer_password);

        $customer_id = DB::table('tbl_customers')->insertGetId($data);

        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);
        Session::put('customer_phone', $request->customer_phone);
        Session::put('customer_address', $request->customer_address);

        return Redirect::to('/home');
    }
    public function login()
    {
        $cate_product = DB::table('tbl_cate_pro')->where('cate_status', '1')->orderby('cate_id', 'desc')->get();
        return view('pages.checkout.login')->with('category', $cate_product);
    }
    public function login_customer(Request $request)
    {
        $email = $request->email;
        $password = md5($request->password);

        $result = DB::table('tbl_customers')->where('customer_email', $email)
        ->where('customer_password', $password)->first();
        if ($result) {
            session()->regenerate();
            Session::put('customer_name', $result->customer_name);
            Session::put('customer_id', $result->customer_id);
            Session::put('customer_phone', $result->customer_phone);
            Session::put('customer_address', $result->customer_address);

            return Redirect::to('/home');
        } else {
            return Redirect::to('/login_checkout')->with('message',"Vui lòng đăng nhập lại!!");
        }
    }

    public function check_out(Request $request)
    {
        $cate_product = DB::table('tbl_cate_pro')->where('cate_status', '1')->orderby('cate_id', 'desc')->get();
            $meta_desc = $request->product_desc;
            $meta_keywords = $request->product_name;
            $meta_title = $request->product_name;
            $meta_url = $request->url();
        return view('pages.checkout.check_out')->with('category', $cate_product)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)
        ->with('meta_title', $meta_title)->with('meta_url', $meta_url);
    }
    public function delete_to_checkout($id)
    {
        Cart::remove($id);
        return Redirect::to('/check-out');
    }
    public function save_checkout(Request $request)
    {
        $data = array();
        $data['customer_id'] = $request->customer_id;
        $data['ship_name'] = $request->ship_name;
        $data['ship_phone'] = $request->ship_phone;
        $data['ship_address'] = $request->ship_address;
        $data['ship_note'] = $request->ship_note;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data['created_at'] = now();
        $ship_id = DB::table('tbl_ship')->insertGetId($data);
        Session::put('ship_id', $ship_id);

        $content = Cart::getContent();
       //echo $content;
        $order_data = array();

        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['ship_id'] = Session::get('ship_id');
        $order_data['order_status'] = 0;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order_data['created_at'] = now();
        $order_id = DB::table('tbl_orders')->insertGetId($order_data);

        //insert order_detail
        $content = Session::get('cart');
        foreach ( $content as $value){
            $orders_data = array();
            $orders_data['order_id'] = $order_id;
            $orders_data['product_id'] = $value->id;
            $orders_data['product_name'] = $value->name;
            $orders_data['product_price'] = $value->price;
            $orders_data['product_quantity'] = $value->quantity;
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $orders_data['created_at'] = now();
             DB::table('tbl_order_details')->insert($orders_data);
        }
        Cart::clear();
        return view('pages.cart.cart');
    }
    public function order(Request $request)
    {
        return Redirect::to('/cart');
    }

    public function log_out()
    {
        Session::flush();
        return Redirect::to('/');
    }
    public function manage_order()
    {
        $list_order = DB::table('tbl_orders')
        ->join('tbl_customers', 'tbl_orders.customer_id', '=', 'tbl_customers.customer_id')
        ->select('tbl_orders.*', 'tbl_customers.customer_name')
        ->orderBy('tbl_orders.order_id', 'desc')
        ->get();
        $manager_order = view('admin.manage_order')->with('list_order', $list_order);

        return view('admin_dashboard')->with('admin.manage_order', $manager_order);

    }
    public function manage_customer()
    {
        $list_customer = DB::table('tbl_customers')->get();
        $manager_customer = view('admin.manage_customer')->with('list_customer', $list_customer);

        return view('admin_dashboard')->with('admin.manage_customer', $manager_customer);

    }
    public function view_order($orderId){
        $order_byId = DB::table('tbl_orders')->where('tbl_orders.order_id', $orderId)
        ->join('tbl_customers', 'tbl_orders.customer_id', '=', 'tbl_customers.customer_id')
        ->join('tbl_ship', 'tbl_orders.ship_id', '=', 'tbl_ship.ship_id')
        ->join('tbl_order_details', 'tbl_orders.order_id', '=', 'tbl_order_details.order_id')

        ->select('tbl_orders.*', 'tbl_customers.*', 'tbl_ship.*', 'tbl_order_details.*')
        ->first();
        $manager_orderId = view('admin.view_order')->with('order_byId', $order_byId);

        return view('admin_dashboard')->with('admin.view_order', $manager_orderId);
    }
    public function confirm_order(Request $request){
        $data = $request->all();
        $ship = new Ship();
        $ship->customer_id = $data['customer_id'];
        $ship->ship_name = $data['ship_name'];
        $ship->ship_phone = $data['ship_phone'];
        $ship->ship_address = $data['ship_address'];
        $ship->ship_note = $data['ship_note'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ship->created_at = now();
        $ship->save();
        $ship_id = $ship->ship_id;

        $code = substr(md5(microtime()),rand(0,26),5);
        $order = new Order;
        $order->customer_id = Session::get('customer_id');
        $order->ship_id = $ship_id;
        $order->order_code = $code;
        $order->order_status = 0;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order->created_at = now();
        $order->save();

        if(Session::get('cart')){
            foreach(Session::get('cart') as $key => $cart){
                $order_detail = new OrderDetails;
                $order_detail->order_code = $code;
                $order_detail->product_id = $cart['product_id'];
                $order_detail->product_name = $cart['product_name'];
                $order_detail->product_price = $cart['product_price'];
                $order_detail->product_quantity = $cart['product_quantity'];
                $order_detail->created_at = now();
                $order_detail->save();
            }
        }

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_email = "Đơn hàng xác nhận ngày".' '.$now;
        $customer = Customer::find(Session::get('customer_id'));
        $data['email'][] = $customer->customer_email;

        if(Session::get('cart') == true){
            foreach(Session::get('cart') as $key =>$cart_email){
                $cart_array[] = array(
                    'product_name' => $cart_email['product_name'],
                    'product_price' => $cart_email['product_price'],
                    'product_quantity' => $cart_email['product_quantity']
                );
            }
        }
        $ship_array = array(
            'customer_name' => $customer->customer_name,
            'ship_name' => $data['ship_name'],
            'ship_address' => $data['ship_address'],
            'ship_phone' => $data['ship_phone'],
            'ship_note' => $data['ship_note'],

        );
        $ordercode_mail = array(
            'order_code' => $code,
            'created_at' => $order->created_at,
            'customer_email' => $customer->customer_email,
            'customer_phone' => $customer->customer_phone,
            'customer_address' => $customer->customer_address,
        );

        Mail::send('pages.mail.mail_order', ['cart_array' => $cart_array, 'ship_array' => $ship_array,
                                             'ordercode_mail' => $ordercode_mail],
            function($message) use ($title_email, $data){
                $message->to($data['email'])->subject($title_email);
                $message->from($data['email'], $title_email);
            });
        Session::forget('cart');
    }



}
