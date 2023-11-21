<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;

use App\Models\OrderDetails;
use Socialite;
use App\Models\Login;
use App\Models\Social;
use App\Models\Statistic;
use App\Models\Visitor;
use Auth;
use Carbon\Carbon;
session_start();
class AdminController extends Controller
{
    public function index()
    {

       return view('admin_login');
    }
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function show_dashboard(Request $request)
    {
        $this->AuthLogin();


        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $user_ip_address = $request->ip();
        $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $end_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $one_year = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

        $visitor_of_lastmonth = Visitor::whereBetween('date_visit',array($early_last_month, $end_last_month))->get();
        $visitor_of_lastmonth_count = $visitor_of_lastmonth->count();

        $visitor_of_thismonth = Visitor::whereBetween('date_visit',array($early_this_month, $now))->get();
        $visitor_of_thismonth_count = $visitor_of_thismonth->count();

        $visitor_of_year = Visitor::whereBetween('date_visit',array($one_year, $now))->get();
        $visitor_of_year_count = $visitor_of_year->count();

        $visitor_current = Visitor::where('ip_address',array($user_ip_address))->get();
        $visitor_count = $visitor_current->count();

        if($visitor_count < 1){
            $visitor = new Visitor();
            $visitor->ip_address = $user_ip_address;
            $visitor->date_visit = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();
        }
        $visitor = Visitor::all();
        $visitor_total = $visitor->count();

        //$product_views = Product::orderBy('product_views', 'desc')->take(20)->get();
        $product_count = Product::all()->count();
        $order_count = Order::where('order_status','0')->get();
        $customer_count = Customer::all()->count();



       return view('admin.dashboard')->with(compact('product_count', 'order_count', 'customer_count',
      'visitor_of_lastmonth_count', 'visitor_of_thismonth_count', 'visitor_count', 'visitor_of_year_count', 'visitor_total'));
    }

    public function dashboard(Request $request)
    {
       $data = $request->all();
        $admin_email = $data['admin_email'];
        $admin_password = md5($data['admin_password']);
        $login = Login::where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        if( $login ){
            $login_count = $login->count();
            if($login_count > 0){
                Session::put('admin_name', $login->admin_name);
                Session::put('admin_id', $login->admin_id);
                return Redirect::to('/dashboard');
                }
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
    public function logout_admin(Request $request)
    {
        Auth::logout();
     return Redirect::to('/admin');
    }
    public function admin_search (Request $request)
    {
        $key = $request->key_word;
        $cate_product = DB::table('tbl_cate_pro')->where('cate_status', '1')->orderby('cate_id', 'desc')->get();
        $search_product = DB::table('tbl_product')->where('product_name', 'like', '%'.$key.'%')->get();
        return view('admin.search.search')->with('category', $cate_product)
        ->with('search_product', $search_product);

    }
    public function search_customer (Request $request)
    {
        $key = $request->key_word;
        $customer = DB::table('tbl_customers')->orderby('customer_id', 'desc')->get();
        $search_customer = DB::table('tbl_customers')->where('customer_name', 'like', '%'.$key.'%')->get();
        return view('admin.search.search_customer')->with('customer', $customer)->with('search_customer', $search_customer);
    }
    public function search_order (Request $request)
    {
        $key = $request->key_word;
        $all_order = Order::where('order_code', 'desc')->get();
        $search_order = Order::where('order_code', 'like', '%'.$key.'%')->get();
      //  $search_order = OrderDetails::where('order_code', 'like', '%'.$key.'%')->get();
        return view('admin.search.search_order')->with('all_order', $all_order)->with('search_order', $search_order);
    }
    public function search_review ()
    {
        return view('admin.search.search_review');
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
    public function wait_pay()
    {
        $wait_pay =  Order::where('order_status', '1')
        ->orderBy('created_at', 'DESC')->get();
            return view('admin.order.wait_pay')->with(compact('wait_pay'));
}
    public function delivery()
        {
            $delivery =  Order::where('order_status', '2')
            ->orderBy('created_at', 'DESC')->get();
                return view('admin.order.delivery')->with(compact('delivery'));
    }
    public function success_delivery()
        {
            $success_delivery =  Order::where('order_status', '3')
            ->orderBy('created_at', 'DESC')->get();
                return view('admin.order.success_delivery')->with(compact('success_delivery'));
    }
    public function cancel()
        {
            $cancel =  Order::where('order_status', '4')
            ->orderBy('created_at', 'DESC')->get();
                return view('admin.order.cancel')->with(compact('cancel'));
    }
    public function delivery_failed()
        {
            $delivery_failed =  Order::where('order_status', '5')
            ->orderBy('created_at', 'DESC')->get();
                return view('admin.order.delivery_failed')->with(compact('delivery_failed'));
    }
    public function filter_by_date(Request $request){
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = Statistic::whereBetween('order_date',array($from_date,$to_date))->orderBy('order_date', 'ASC')->get();
        $chart = [];
        foreach($get as $key => $value){
            $chart[] = array(
                'period' => $value->order_date,
                'order' => $value->total_order,
                'sale' => $value->sale,
                'profit' => $value->profit,
                'quantity' => $value->quantity
            );
        }
        echo $data = json_encode($chart);
    }
    public function order_date(Request $request){
        $order_date = $_GET['date'];
        $order = Order::where('order_date', $order_date)->orderBy('created_at', 'DESC')->get();
        return view('admin.order_date')->with(compact('order'));
    }
    public function dashboard_filter(Request $request){
        $data = $request->all();
        //echo $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $start_of_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $early_of_lastmonth = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $late_of_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if($data['dashboard_value'] == '7days'){

            $get = Statistic::whereBetween('order_date',array($sub7days,$now))->orderBy('order_date', 'ASC')->get();

        }elseif($data['dashboard_value'] == 'lastmonth'){

            $get = Statistic::whereBetween('order_date',array($early_of_lastmonth,$late_of_month))->orderBy('order_date', 'ASC')->get();

        }elseif($data['dashboard_value'] == 'thismonth'){
            $get = Statistic::whereBetween('order_date',array($start_of_month,$now))->orderBy('order_date', 'ASC')->get();
        }else{
            $get = Statistic::whereBetween('order_date',array($sub365days,$now))->orderBy('order_date', 'ASC')->get();

        }
        foreach($get as $k =>$val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sale' => $val->sale,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);

    }
    public function days_order(){
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Statistic::whereBetween('order_date',array($sub30days,$now))->orderBy('order_date', 'ASC')->get();
        foreach($get as $k =>$val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sale' => $val->sale,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }


}
