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
use App\Models\OrderRating;
use App\Models\OrderDetails;
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
    public function send_rating(Request $request){
        $data = $request->all();
        $rating = new OrderRating();
        $rating->order_code = $data['order_code'];
        $rating->rating = $data['index'];
        $rating->save();
    }
    public function order_review(Request $request){
        $order_code = $request->order_code;
        $customer_id = $request->customer_id;
        $order_review = OrderReview::with('customer')->where('order_id',$order_code)
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
    public function manage_review(){
        $review = OrderReview::with('order')->with('customer')->with('rating')
        ->orderBy('order_review', 'desc')->paginate(10);
        $order_detail = OrderDetails::where('order_code')->get();
        $rating = OrderRating::with('review')->get();
        return view('admin.rating.manage_review')->with(compact('review', 'order_detail', 'rating'));
    }


}
