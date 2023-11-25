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
use PDF;
use Carbon\Carbon;
use Mail;
use App\Mail\Gmail;
class OrderController extends Controller
{
    public function ordered($customerId)
    {
        $get_order = Order::where('customer_id', Session::get('customer_id'))
        ->orderBy('created_at', 'DESC')->get();
        return view('customer.ordered')->with(compact('get_order'));

    }
    public function wait_pay($customerId)
    {
        $wait_pay =  Order::where('customer_id', Session::get('customer_id'))->where('order_status', '1')
        ->orderBy('created_at', 'DESC')->get();
            return view('customer.wait_pay')->with(compact('wait_pay'));
}
    public function delivery($customerId)
        {
            $delivery =  Order::where('customer_id', Session::get('customer_id'))->where('order_status', '2')
            ->orderBy('created_at', 'DESC')->get();
                return view('customer.delivery')->with(compact('delivery'));
    }
    public function success_delivery($customerId)
        {
            $success_delivery =  Order::where('customer_id', Session::get('customer_id'))->where('order_status', '3')
            ->orderBy('created_at', 'DESC')->get();
                return view('customer.success_delivery')->with(compact('success_delivery'));
    }
    public function cancel($customerId)
        {
            $cancel =  Order::where('customer_id', Session::get('customer_id'))->where('order_status', '4')
            ->orderBy('created_at', 'DESC')->get();
                return view('customer.cancel')->with(compact('cancel'));
    }
    public function delivery_failed($customerId)
        {
            $delivery_failed =  Order::where('customer_id', Session::get('customer_id'))->where('order_status', '5')
            ->orderBy('created_at', 'DESC')->get();
                return view('customer.delivery_failed')->with(compact('delivery_failed'));
    }

    public function view_ordered($order_id)
    {
        $order_details = OrderDetails::with('product')->where('order_code', $order_id)->get();
        $order = Order::where('order_code', $order_id)->get();

        foreach ($order as $key => $value) {
            $customer_id = $value->customer_id;
            $ship_id = $value->ship_id;
            $order_status = $value->order_status;
        }
        $customer = Customer::where('customer_id', $customer_id)->first();
        $ship = Ship::where('ship_id', $ship_id)->first();
        $order_details_product = OrderDetails::with('product')->where('order_code', $order_id)->get();

        return view('customer.view_ordered')
        ->with(compact('order_details', 'customer', 'ship', 'order', 'order_status'));

    }
    public function manage_order()
    {
        $all_order = Order::orderBy('created_at', 'DESC')->paginate(5);

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
        }
        $customer = Customer::where('customer_id', $customer_id)->first();
        $ship = Ship::where('ship_id', $ship_id)->first();
        $order_details_product = OrderDetails::where('order_code', $order_id)->get();

        return view('admin.view_order')->with(compact('order_details','order_details_product',
         'customer', 'ship', 'order', 'order_status'));
    }

    public function update_quantity_order(Request $request)
    {
        $data = $request->all();
        $order = Order::find($data['order_code']);
        $order->order_status = $data['order_status'];
        $order->save();
        if($order->order_status == 1){
            $order->order_status = 1;
            $order->save();
            $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
            $title_email = "Đơn hàng đã được xác nhận".' '.$now;
            $customer = Customer::where('customer_id', $order->customer_id)->first();
            $data['email'][] = $customer->customer_email;
            $code = substr(md5(microtime()),rand(0,26),5);
            foreach($data['order_product_id'] as $key =>$product){
                $product_mail = Product::find($product);
                foreach($data['quantity'] as $key2 => $qty){
                    if($key ==$key2){
                        $cart_array[] = array(
                            'product_name' => $product_mail['product_name'],
                            'product_price' => $product_mail['product_price'],
                            'product_quantity' => $qty,
                       );
                   }
               }
           }
           $detail = OrderDetails::where('order_code', $order->order_code)->first();
           $ship = Ship::where('ship_id', $order->ship_id)->first();
           $ship_array = array(
               'customer_name' => $customer->customer_name,
               'ship_name' => $ship['ship_name'],
               'ship_address' => $ship['ship_address'],
               'ship_phone' => $ship['ship_phone'],
               'ship_note' => $ship['ship_note'],

           );
           $ordercode_mail = array(
               'order_code' => $code,
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
        }elseif ($order->order_status == 3) {
            foreach ($data['order_product_id'] as $key => $product_id) {
                $product = Product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;
                foreach ($data['quantity'] as $key2 => $qty) {
                    if ($key == $key2) {
                        $product_remain = $product_quantity - $qty;
                        $product->product_quantity = $product_remain;
                        $product->product_sold = $product_sold + $qty;
                        $product->save();
                    }
                }
            }
             //send mail
             $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
             $title_email = "Đơn hàng đã giao hàng thành công".' '.$now;
             $customer = Customer::where('customer_id', $order->customer_id)->first();
             $data['email'][] = $customer->customer_email;
             $code = substr(md5(microtime()),rand(0,26),5);
             foreach($data['order_product_id'] as $key =>$product){
                 $product_mail = Product::find($product);
                 foreach($data['quantity'] as $key2 => $qty){
                     if($key ==$key2){
                         $cart_array[] = array(
                             'product_name' => $product_mail['product_name'],
                             'product_price' => $product_mail['product_price'],
                             'product_quantity' => $qty,
                        );
                    }
                }
            }
            $detail = OrderDetails::where('order_code', $order->order_code)->first();
            $ship = Ship::where('ship_id', $order->ship_id)->first();
            $ship_array = array(
                'customer_name' => $customer->customer_name,
                'ship_name' => $ship['ship_name'],
                'ship_address' => $ship['ship_address'],
                'ship_phone' => $ship['ship_phone'],
                'ship_note' => $ship['ship_note'],

            );
            $ordercode_mail = array(
                'order_code' => $code,
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
        } elseif ($order->order_status != 2 && $order->order_status != 3 && $order->order_status == 5) {
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
            .table2{
                position: absolute;
                bottom: 80;
                height: 2.5rem;
            }
            .a{
                margin-right:10px;
            }
            .c{
                margin-right: 160px
            }

            .b{
                margin-left:170px;
            }
            .e{
                margin-left:220px;
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
                <tr>
                    <td>
                        <div class="a">
                            <p class=""><b>Người đặt hàng</b></p>
                            <p class="">Họ tên: '.$customer->customer_name.'</p>
                            <p>Số điện thoại: '.$customer->customer_phone.'</p>
                            <p>Email: '.$customer->customer_email.'</p>
                            <p>Địa chỉ: '.$customer->customer_address.'</p>
                            <p>Ngày đặt: '.$order->created_at.'</p>


                        </div>
                    </td>
                    <td>
                        <div class="b">
                            <p class=""><b>Người nhận hàng</b></p>
                            <p>Họ tên: '.$ship->ship_name.'</p>
                            <p>Số điện thoại: '.$ship->ship_phone.'</p>
                            <p>Địa chỉ: '.$ship->ship_address.'</p>
                            <p>Ghi chú: '.$ship->ship_note.'</p>
                        </div>
                    </td>
                </tr>
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
                    <tr>
                        <td>'.$product->product_name.'&nbsp; &nbsp;&nbsp; &nbsp;</td>
                        <td>'.$product->product_color.'&nbsp; &nbsp;&nbsp; &nbsp;</td>
                        <td>'.$product->product_size.'&nbsp; &nbsp;&nbsp; &nbsp;</td>
                        <td>'.number_format($product->product_price,0,',',',').'đ'.'</td>
                        <td> &nbsp; &nbsp;&nbsp; &nbsp;'.$product->product_quantity.'</td>
                        <td>'.number_format($subtotal,0,',',',').'đ'.'</td>
                    </tr>';
                }
        $output.='
                <tr>
                    <td><p>Phí vận chuyển: 0đ</p>
                        <p>Tổng thanh toán: '.number_format($total,0,',',',').'đ'.'</p>
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
            <td>
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
            <table class="table2">
                <thead >
                    <tr>
                        <th>
                            <p class="c">THÔNG TIN LIÊN HỆ</p>
                        </th>
                    </tr>
                </thead>
                <tbody>';
        $output.='
                    <tr>
                        <td>
                            <div class="a">
                                <p>Số điện thoại: 0795484345</p>
                                <p>Email: lethikimnhuhb@gmail.com</p>
                            </div>
                        </td>
                        <td>
                            <div class="e font">
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
}
