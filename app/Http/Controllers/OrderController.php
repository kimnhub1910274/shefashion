<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
session_start();
use App\Models\Product;
use App\Models\Ship;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Customer;
use App\Models\Statistic;
use PDF;
use Carbon\Carbon;
use Mail;
use App\Mail\Gmail;
use App\Models\OrderRating;

class OrderController extends Controller
{


    public function view_ordered($order_id)
    {
        $order_details = OrderDetails::with('product')->where('order_code', $order_id)->get();
        $order = Order::with('review')->where('order_code', $order_id)->get();

        foreach ($order as $key => $value) {
            $customer_id = $value->customer_id;
            $ship_id = $value->ship_id;
            $order_status = $value->order_status;
            $order_code = $value->order_code;

        }
        $customer = Customer::where('customer_id', $customer_id)->first();
        $ship = Ship::where('ship_id', $ship_id)->first();
        $order_details_product = OrderDetails::with('product')->where('order_code', $order_id)->get();

        $rating = OrderRating::where('order_code', $order_code)->avg('rating');
        $rating = round($rating);

        return view('customer.view_ordered')
        ->with(compact('order_details', 'customer', 'ship', 'order', 'order_status', 'order_code', 'rating'));

    }
    public function manage_order()
    {
        $all_order = Order::orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.manage_order')->with(compact('all_order'));
    }
    public function view_order($order_id)
    {
        $order_details = OrderDetails::with('product')->where('order_code', $order_id)->get();
        $order = Order::where('order_code', $order_id)->get();

        foreach ($order as $key => $value) {
            $customer_id = $value->customer_id;
            $ship_id = $value->ship_id;
            $order_status = $value->order_status;
            $order_code = $value->order_code;

        }
        $customer = Customer::where('customer_id', $customer_id)->first();
        $ship = Ship::where('ship_id', $ship_id)->first();
        $order_details_product = OrderDetails::where('order_code', $order_id)->get();

        $rating = OrderRating::where('order_code', $order_code)->avg('rating');
        $rating = round($rating);

        return view('admin.view_order')->with(compact('order_details','order_details_product',
         'customer', 'ship', 'order', 'order_status', 'rating'));
    }

    public function update_quantity_order(Request $request)
    {
        $data = $request->all();
        $order = Order::find($data['order_code']);
        $order->order_status = $data['order_status'];
        $order->save();

        $order_date = $order->order_date;
        $statistic = Statistic::where('order_date', $order_date)->get();
        if($statistic){
            $statistic_count = $statistic->count();
        }

        if($order->order_status == 1){
            $order->order_status = 1;
            $order->save();
            $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
            $title_email = "Đơn hàng đã được xác nhận".' '.$now;
            $customer = Customer::where('customer_id', $order->customer_id)->first();
            $data['email'][] = $customer->customer_email;
           // $code = substr(md5(microtime()),rand(0,26),5);
            foreach($data['order_product_id'] as $key =>$product_id){
                $product = Product::find($product_id);
                $product_mail = Product::find($product_id);
                $detail = OrderDetails::where('order_code', $order->order_code)->first();
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;
                //
                $product_price = $product->product_price;
                $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
                foreach($data['quantity'] as $key2 => $qty){
                    if($key ==$key2){
                        $cart_array[] = array(
                            'product_name' => $product_mail['product_name'],
                            'product_price' => $product_mail['product_price'],
                            'product_qty' => $qty,
                            'product_color' => $detail['product_color'],
                            'product_size' => $detail['product_size'],

                       );
                       $product_remain = $product_quantity - $qty;
                        $product->product_quantity = $product_remain;
                        $product->product_sold = $product_sold + $qty;
                        $product->save();
                   }
               }
           }
           $detail = OrderDetails::where('order_code', $order->order_code)->first();
           $ship = Ship::where('ship_id', $order->ship_id)->first();
           $ship_array = array(
               'customer_name' => $customer->customer_name,
               'ship_name' => $ship['ship_name'],
               'ship_address' => $ship['ship_address'],
               'ship_note' => $ship['ship_note'],
               'ship_fee' => $ship['ship_fee'],
               'payment_method' => $ship['payment_method'],

           );
           $ordercode_mail = array(
               'order_code' => $order->order_code,
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
        }elseif ($order->order_status == 3) {
            //
            $total_order = 0;
            $sale = 0;
            $profit = 0;
            $quantity = 0;
            foreach ($data['order_product_id'] as $key => $product_id) {
                $product = Product::find($product_id);

                $product_price = $product->product_price;

                $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

                foreach ($data['quantity'] as $key2 => $qty) {
                  //  if ($key == $key2) {
                       // $product_remain = $product_quantity - $qty;
                      //  $product->product_quantity = $product_remain;
                       // $product->product_sold = $product_sold + $qty;
                        //$product->save();
                        //update statistical
                        $quantity = $quantity + $qty;
                        $total_order = $total_order + 1;
                        $sale = $product_price * $qty;
                        $profit = $sale * 0.3;

                   // }
                }
            }
            //order_date

            if($statistic_count > 0){
                $statistic_update = Statistic::where('order_date', $order_date)->first();
                $statistic_update->sale = $statistic_update->sale + $sale;
                $statistic_update->profit = $statistic_update->profit + $profit;
                $statistic_update->quantity = $statistic_update->quantity + $quantity;
                $statistic_update->total_order = $statistic_update->total_order + $total_order;
                $statistic_update->save();
            }else{
                $statistic_new = new Statistic();
                $statistic_new->order_date = $order_date;
                $statistic_new->sale = $sale;
                $statistic_new->profit = $profit;
                $statistic_new->quantity = $quantity;
                $statistic_new->total_order = $total_order;
                $statistic_new->save();
            }

             //send mail
             $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
             $title_email = "Đơn hàng đã giao hàng thành công".' '.$now;
             $customer = Customer::where('customer_id', $order->customer_id)->first();
             $data['email'][] = $customer->customer_email;
             //$code = substr(md5(microtime()),rand(0,26),5);
             foreach($data['order_product_id'] as $key =>$product){
                 $product_mail = Product::find($product);
                 $detail = OrderDetails::where('order_code', $order->order_code)->first();
                 foreach($data['quantity'] as $key2 => $qty){
                     if($key ==$key2){
                         $cart_array[] = array(
                             'product_name' => $product_mail['product_name'],
                             'product_price' => $product_mail['product_price'],
                             'product_qty' => $qty,
                             'product_color' => $detail['product_color'],
                            'product_size' => $detail['product_size'],
                        );
                    }
                }
            }
            $ship = Ship::where('ship_id', $order->ship_id)->first();
            $ship_array = array(
                'customer_name' => $customer->customer_name,
                'ship_name' => $ship['ship_name'],
                'ship_address' => $ship['ship_address'],
                'ship_note' => $ship['ship_note'],
                'ship_fee' => $ship['ship_fee'],
                'payment_method' => $ship['payment_method'],



            );
            $ordercode_mail = array(
                'order_code' => $order->order_code,
                'created_at' => $order->created_at,
                'customer_email' => $customer->customer_email,
                'customer_phone' => $customer->customer_phone,
                'customer_address' => $customer->customer_address,
            );

            Mail::send('admin.confirm_order', ['cart_array' => $cart_array, 'ship_array' => $ship_array,
                                                'ordercode_mail' => $ordercode_mail],
                function($message) use ($title_email, $data){
                    $message->to($data['email'])->subject($title_email);
                    $message->from($data['email'], $title_email);
                });
        } elseif ($order->order_status == 4 || $order->order_status == 5) {
            foreach ($data['order_product_id'] as $key => $product_id) {
                $product = Product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;
                foreach ($data['quantity'] as $key2 => $qty) {
                    if ($key == $key2) {
                        $product_remain = $product_quantity + $qty;
                        $product->product_quantity = $product_remain;
                        $product->product_sold = $product_sold - $qty;
                        $product->save();
                    }

                }
            }
        }


    }
    public function update_qty_order(Request $request)
    {
        $data = $request->all();
        $order_details = OrderDetails::where('product_id', $data['order_product_id'])
        ->where('order_code', $data['order_code'])->first();

        $order_details->product_quantity = $data['order_qty'];
        $order_details->save();

    }

    public function print_order( $checkout_code ){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }
    public function print_order_convert($checkout_code){
        $order_details = OrderDetails::with('product')->where('order_code', $checkout_code)->get();
        $order = Order::where('order_code', $checkout_code)->get();

        foreach ($order as $key => $value) {
            $customer_id = $value->customer_id;
            $ship_id = $value->ship_id;
            $order_status = $value->order_status;

        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $create_date = now();
        $ship = Ship::where('ship_id', $ship_id)->first();
        $customer = Customer::where('customer_id', $customer_id)->first();
        $order = Order::where('order_code', $checkout_code)->first();
        $order_details_product = OrderDetails::with('product')->where('order_code', $checkout_code)->get();
        $output = '';

        $output.='
        <style>
            body{
                font-family:DejaVu Sans;
                font-size: 15px;
            }
            .a{
                margin-right:10px;
            }

            .b{
                margin-left:150px;
                margin-top:-30px;
            }
            .e{
                margin-left:200px;
            }

        </style>
        <h1><center>SheFashion</center></h1>
        <hr>
        <p>Ngày in hóa đơn: '.$create_date.'</p>
        <h3><center>HÓA ĐƠN BÁN HÀNG</center></h3>
        <center>----------</center>
        <table class="">

            <tbody>';
    $output.='
                <div class="row">
                    <div class="col">
                        <p class=""><b>Người đặt hàng</b></p>
                        <p class="">Họ tên: '.$customer->customer_name.'</p>
                        <p>Số điện thoại: '.$customer->customer_phone.'</p>
                        <p>Email: '.$customer->customer_email.'</p>
                        <p>Địa chỉ: '.$customer->customer_address.'</p>
                        <p>Ngày đặt: '.$order->created_at.'</p>
                    </div>
                    <div class="col">
                        <p class=""><b>Người nhận hàng</b></p>
                        <p>Địa chỉ: '.$ship->ship_address.'</p>
                        <p>Ghi chú: '.$ship->ship_note.'</p>
                    </div>
                </div>
                ';
    $output.='

            </tbody>
        </table>';
    $output.='
            <table class="table1">
                <thead>
                    <tr>
                        <th><p class="c">Tên sản phẩm</p></th>
                        <th><p class="c">Màu sản phẩm</p></th>
                        <th><p class="c">Kích cỡ sản phẩm</p></th>
                        <th>Giá &nbsp;</th>
                        <th>Số lượng  &nbsp;</th>
                        <th>Thành tiền  &nbsp;</th>
                    </tr>
                </thead>
                <tbody>';
                    $total = 0;
                    foreach($order_details_product as $key => $product){
                        $subtotal = $product->product_price*$product->product_quantity;
                        $total = $subtotal+$total;
        $output.='
                    <tr style="text-align: center">
                        <td>'.$product->product_name.'&nbsp; &nbsp;&nbsp; &nbsp;</td>
                        <td>'.$product->product_color.'</td>
                        <td>'.$product->product_size.'</td>
                        <td>'.number_format($product->product_price,0,',',',').'đ'.'</td>
                        <td> '.$product->product_quantity.'</td>
                        <td>'.number_format($subtotal,0,',',',').'đ'.'</td>
                    </tr>';
                }
        $output.='
                <tr>
                    <td><p>Phí vận chuyển: '.number_format($ship->ship_fee).'</p>
                        <p>Tổng thanh toán: '.number_format($subtotal + $ship->ship_fee).'</p>
                    </td>
                </tr>
        ';
        $output.='
                </tbody>
            </table>';
            $output.='
            <table class="table3">
                <tbody>';
        $output.='
        <tr>
            <td>
                <div class="a">
                    <p class=""><b>Người lập hóa đơn</b></p>
                    <small><center>(Ký xác nhận)</center></small>
                </div>
            </td>
            <td colpan=5>
                <div class="e">
                    <p class=""><b>Người nhận hàng</b></p>
                    <small><center>(Ký xác nhận)</center></small>

                </div>
            </td>
        </tr>
                    ';
        $output.='

                </tbody>
            </table>';
        $output.='

            <table class="table2" style="position: absolute;
                bottom: 80;
                height: 2.5rem;">
                <thead >
                    <tr>
                        <th>
                            <p class="" style="margin-top: 70px">THÔNG TIN LIÊN HỆ</p>
                        </th>
                    </tr>
                </thead>
                <tbody>';
        $output.='
                    <tr>
                        <td>
                            <div class="" style="font-size: 10px">
                                <p>Số điện thoại: 0795484345</p>
                                <p>Email: lethikimnhuhb@gmail.com</p>
                            </div>
                        </td>
                        <td>
                            <div class="e" >
                                <h2>CẢM ƠN!</h2>
                            </div>
                        </td>
                    </tr>
                    ';
        $output.='

                </tbody>
            </table>';

        return $output;
    }
    public function ordered($customerId)
    {
        $get_order = Order::where('customer_id', Session::get('customer_id'))
        ->orderBy('created_at', 'DESC')->paginate(10);
        return view('customer.ordered')->with(compact('get_order'));

    }
    public function wait_pay($customerId)
    {
        $wait_pay =  Order::where('customer_id', Session::get('customer_id'))->where('order_status', '1')
        ->orderBy('created_at', 'DESC')->paginate(10);
            return view('customer.wait_pay')->with(compact('wait_pay'));
}
    public function delivery($customerId)
        {
            $delivery =  Order::where('customer_id', Session::get('customer_id'))->where('order_status', '2')
            ->orderBy('created_at', 'DESC')->paginate(10);
                return view('customer.delivery')->with(compact('delivery'));
    }
    public function success_delivery($customerId)
        {
            $success_delivery =  Order::where('customer_id', Session::get('customer_id'))->where('order_status', '3')
            ->orderBy('created_at', 'DESC')->paginate(10);
                return view('customer.success_delivery')->with(compact('success_delivery'));
    }
    public function cancel($customerId)
        {
            $cancel =  Order::where('customer_id', Session::get('customer_id'))->where('order_status', '4')
            ->orderBy('created_at', 'DESC')->paginate(10);
                return view('customer.cancel')->with(compact('cancel'));
    }
    public function delivery_failed($customerId)
        {
            $delivery_failed =  Order::where('customer_id', Session::get('customer_id'))->where('order_status', '5')
            ->orderBy('created_at', 'DESC')->paginate(10);
                return view('customer.delivery_failed')->with(compact('delivery_failed'));
    }
    public function cancel_order(Request $request)
    {
        $data = $request->all();
        $order = Order::where('order_code', $data['order_code'])->first();
        $order->order_cancel = $data['reason'];
        $order->order_status = 4;
        $order->save();
    }
    public function cancel_order_customer(Request $request)
    {
        $data = $request->all();
        $order = Order::where('order_code', $data['order_code'])->first();
        $order->order_status = 4;
        $order->save();
    }
    public function accept_order(Request $request)
    {
        $data = $request->all();
        $order = Order::where('order_code', $data['order_code'])->first();
        $order->order_status = 1;
        $order->save();

    }
    public function delete_order($order_code )
    {
        Order::where('order_code', $order_code)->delete();
        OrderDetails::where('order_code', $order_code)->delete();
        return Redirect::to('manage-order');

    }


}
