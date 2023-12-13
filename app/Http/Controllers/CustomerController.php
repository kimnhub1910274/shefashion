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
        $get_address = Address::where('id_customer', Session::get('customer_id'))
        ->join('tbl_customers', 'tbl_customers.customer_id', '=', 'tbl_address.id_customer')

        ->orderby('tbl_address.id_address')->paginate(5);
        $address_count = $get_address->count();
        return view('customer.address')->with(compact('get_address', 'address_count'));
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
    public function add_address(Request $request){
        $data = $request->all();
        $address = new Address();
        $address->id_customer = $data['id_customer'];
        $address->name = $data['name'];
        $address->phone = $data['phone'];
        $address->locate = $data['location'];
        $address->save();
     }

    public function delete_address($address_id){
        $get_address = Address::where('id_customer', Session::get('customer_id'))
        ->join('tbl_customers', 'tbl_customers.customer_id', '=', 'tbl_address.id_customer')

        ->orderby('tbl_address.id_address')->paginate(5);
        $address_count = $get_address->count();
       Address::where('id_address', $address_id)->delete();
       return view('customer.address')->with(compact('get_address', 'address_count'));
    }
    public function edit_infor(Request $request, $customer_id){
        $data = array();
       // $customer = Customer::where('customer_id',$customer_id)->first();
        $data['customer_email'] = $request->email;
        $data['customer_name'] = $request->name;
        $data['customer_phone'] = $request->phone;
        Customer::where('customer_id',$customer_id)->update($data);
        Session::put('message', 'Cập nhật thông tin thành công');
        return Redirect::back();
     }

}
