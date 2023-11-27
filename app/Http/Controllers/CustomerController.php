<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
session_start();
use App\Models\Customer;
use App\Models\Address;

class CustomerController extends Controller
{
    public function customer()
    {
        $get_customer = Customer::where('customer_id', Session::get('customer_id'))->get();
        return view('customer.customer')->with('get_customer', $get_customer);
    }
    public function address()
    {
        $get_address = DB::table('tbl_address')->where('id_customer', Session::get('customer_id'))
        ->join('tbl_customers', 'tbl_customers.customer_id', '=', 'tbl_address.id_customer')

        ->orderby('tbl_address.id_address')->paginate(5);

        $address = view('customer.address')->with('get_address', $get_address);
        return view('customer')->with('customer.address', $address);
    }
    public function approve_customer(Request $request){
        $data = $request->all();
        $customer = Customer::find($data['customer_id']);
        $customer->customer_status = $data['customer_status'];
        $customer->save();
        Session::put('customer_name', null);
        Session::put('customer_id', null);
        Session::put('cart', null);
    }
}
