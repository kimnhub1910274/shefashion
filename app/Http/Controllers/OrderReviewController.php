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
        $order_code = $request->order_code;
        $customer_id = $request->customer_id;
        $order_review = OrderReview::with('customer')->where('order_code',$order_code)
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
        $data = $request->all();
        $order_code = $request->order_code;
        $customer_id = $request->customer_id;
        $review = $request->review;
        $order_review = new OrderReview();
        $order_review->customer_id = $customer_id;
        $order_review->review = $review;
        $order_review->order_code = $order_code;
        //$order_review->rating = $data['index'];
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
        $order_review = OrderReview::with('customer')->where('order_code',$order_code)
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
        $review = DB::table('tbl_order_review')
        ->join('tbl_customers', 'tbl_customers.customer_id', '=', 'tbl_order_review.customer_id')
        ->join('tbl_rating', 'tbl_rating.order_code', '=', 'tbl_order_review.order_code')
        ->orderBy('tbl_order_review.order_review', 'desc')->paginate(10);
        return view('admin.rating.manage_review')->with(compact('review', ));
    }
    public function five_star(){
        $five_star = DB::table('tbl_order_review')
        ->join('tbl_customers', 'tbl_customers.customer_id', '=', 'tbl_order_review.customer_id')
        ->join('tbl_rating', 'tbl_rating.order_code', '=', 'tbl_order_review.order_code')
        ->where('tbl_rating.rating', '5')
        ->orderBy('tbl_order_review.order_review', 'desc')->paginate(10);
        return view('admin.rating.five_star')->with(compact('five_star'));
    }
    public function four_star(){
        $four_star = DB::table('tbl_order_review')
        ->join('tbl_customers', 'tbl_customers.customer_id', '=', 'tbl_order_review.customer_id')
        ->join('tbl_rating', 'tbl_rating.order_code', '=', 'tbl_order_review.order_code')
        ->where('tbl_rating.rating', '4')
        ->orderBy('tbl_order_review.order_review', 'desc')->paginate(10);
        return view('admin.rating.four_star')->with(compact('four_star'));
    }public function three_star(){
        $three_star = DB::table('tbl_order_review')
        ->join('tbl_customers', 'tbl_customers.customer_id', '=', 'tbl_order_review.customer_id')
        ->join('tbl_rating', 'tbl_rating.order_code', '=', 'tbl_order_review.order_code')
        ->where('tbl_rating.rating', '3')
        ->orderBy('tbl_order_review.order_review', 'desc')->paginate(10);
        return view('admin.rating.three_star')->with(compact('three_star'));
    }public function two_star(){
        $two_star = DB::table('tbl_order_review')
        ->join('tbl_customers', 'tbl_customers.customer_id', '=', 'tbl_order_review.customer_id')
        ->join('tbl_rating', 'tbl_rating.order_code', '=', 'tbl_order_review.order_code')
        ->where('tbl_rating.rating', '2')
        ->orderBy('tbl_order_review.order_review', 'desc')->paginate(10);
        return view('admin.rating.two_star')->with(compact('two_star'));
    }public function one_star(){
        $one_star = DB::table('tbl_order_review')
        ->join('tbl_customers', 'tbl_customers.customer_id', '=', 'tbl_order_review.customer_id')
        ->join('tbl_rating', 'tbl_rating.order_code', '=', 'tbl_order_review.order_code')
        ->where('tbl_rating.rating', '1')
        ->orderBy('tbl_order_review.order_review', 'desc')->paginate(10);
        return view('admin.rating.one_star')->with(compact('one_star'));
    }


}
