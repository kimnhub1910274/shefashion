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
use App\Models\Comment;
use Auth;
use Carbon\Carbon;
session_start();
class CommentController extends Controller
{
    public function manage_comment(){
        $comment = Comment::with('product')->where('comment_parent_comment', '=', 0)
        ->orderBy('comment_id', 'desc')->paginate(10);
        $comment_rpl = Comment::with('product')
        ->where('comment_parent_comment', '>', 0)->orderBy('comment_id', 'asc')->paginate(10);
        return view('admin.comment.manage_comment')->with(compact('comment', 'comment_rpl' ));
    }
    public function approve_comment(Request $request){
        $data = $request->all();
        $comment = Comment::find($data['comment_id']);
        $comment->comment_status = $data['comment_status'];
        $comment->save();
    }
    public function reply_comment(Request $request){
        $data = $request->all();
        $comment = new Comment();
        $comment->comment = $data['comment'];
        $comment->comment_product_id = $data['comment_product_id'];
        $comment->comment_parent_comment = $data['comment_id'];
        $comment->comment_status = 1;
        $comment->comment_user = 'Admin';
        $comment->save();
    }
    public function comment_not_approved(){
        $comment = Comment::with('product')->where('comment_parent_comment', '=', 0)
        ->where('comment_status', 0)->paginate(10);
        $comment_rpl = Comment::with('product')
        ->where('comment_parent_comment', '>', 0)->orderBy('comment_id', 'asc')->paginate(10);
        return view('admin.comment.comment_not_approved')->with(compact('comment', 'comment_rpl' ));
    }
    public function comment_approved(){
        $comment = Comment::with('product')->where('comment_parent_comment', '=', 0)
        ->where('comment_status', 1)->paginate(10);
        $comment_rpl = Comment::with('product')
        ->where('comment_parent_comment', '>', 0)->orderBy('comment_id', 'asc')->paginate(10);
        return view('admin.comment.comment_approved')->with(compact('comment', 'comment_rpl' ));
    }



}
