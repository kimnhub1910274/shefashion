<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Excel;
use App\Imports\ImportProduct;
use App\Exports\ExportProduct;
use App\Models\Product;
use App\Models\Comment;
use App\Models\OrderReview;

session_start();

class OrderReviewController extends Controller
{
    public function load_review(Request $request){
        $order_id = $request->order_id;
        $customer_id = $request->customer_id;
        $order_review = OrderReview::with('customer')->where('order_id',$order_id)
        ->where('customer_id', $customer_id)->get();
        $output = '';
        foreach($order_review as $k =>$order){
            $output.= '
                <div class="" style="font-size:15px">
                    <div class="row"  height:100px;" >
                        <div class="col-md-3" >
                            <img src="'.url('public/images/'.$order->img).'"
                                style="width: 80px; height: 80px;"
                            >
                        </div>
                        <div class="col-md-9" style="margin-top: 5px">
                            <p style="color: green">@'.$order->customer->customer_name.'</p>
                            <p style="font-size: 10px; margin-top:-8px; color:gray;">'.$order->review_date.'</p>
                            <p style="margin-top:-8px;">'.$order->review.'</p>
                        </div>
                    </div>
                    ';
        }
        echo $output;
    }
    public function send_review(Request $request){
        $order_id = $request->order_id;
        $customer_id = $request->customer_id;
        $review = $request->review;
        $order_review = new OrderReview();
        $order_review->customer_id = $customer_id;
        $order_review->review = $review;
        $order_review->order_id = $order_id;
        $order_review->save();
    }
}
