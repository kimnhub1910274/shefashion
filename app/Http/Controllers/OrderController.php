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

class OrderController extends Controller
{
    public function ordered($customerId)
    {
        $get_order = Order::where('customer_id', Session::get('customer_id'))
        ->orderBy('created_at', 'DESC')->get();
        return view('pages.cart.ordered')->with(compact('get_order'));

    }
    public function view_ordered($order_id)
    {
        $order_details = OrderDetails::with('product')->where('order_id', $order_id)->get();
        $order = Order::where('order_id', $order_id)->get();

        foreach ($order as $key => $value) {
            $customer_id = $value->customer_id;
            $ship_id = $value->ship_id;
            $order_status = $value->order_status;
        }
        $customer = Customer::where('customer_id', $customer_id)->first();
        $ship = Ship::where('ship_id', $ship_id)->first();
        $order_details_product = OrderDetails::with('product')->where('order_id', $order_id)->get();

        return view('pages.cart.view_ordered')
        ->with(compact('order_details', 'customer', 'ship', 'order', 'order_status'));

    }
    public function manage_order()
    {
        $all_order = Order::orderBy('created_at', 'DESC')->get();
        return view('admin.manage_order')->with(compact('all_order'));
    }
    public function view_order($order_id)
    {
        $order_details = OrderDetails::with('product')->where('order_id', $order_id)->get();
        $order = Order::where('order_id', $order_id)->get();

        foreach ($order as $key => $value) {
            $customer_id = $value->customer_id;
            $ship_id = $value->ship_id;
            $order_status = $value->order_status;
        }
        $customer = Customer::where('customer_id', $customer_id)->first();
        $ship = Ship::where('ship_id', $ship_id)->first();
        $order_details_product = OrderDetails::where('order_id', $order_id)->get();

        return view('admin.view_order')->with(compact('order_details','order_details_product',
         'customer', 'ship', 'order', 'order_status'));
    }
    public function update_quantity_order(Request $request)
    {
        $data = $request->all();
        $order = Order::find($data['order_id']);
        $order->order_status = $data['order_status'];
        $order->save();
        if ($order->order_status == 3) {
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
        } elseif ($order->order_status != 2 && $order->order_status != 3 && $order->order_status == 4) {
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
        ->where('order_id', $data['order_id'])->first();

        $order_details->product_quantity = $data['order_qty'];
        $order_details->save();
    }

}
