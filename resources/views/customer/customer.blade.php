@extends('customer')
@section('customer')
<title>Trang người dùng</title>
<div class="" >
    <div class="container" style="margin-top:0px; margin-bottom:100px;">
        &nbsp;
        <?php
        $message = Session::get('message');
        if($message){
            echo $message;
            Session::pull('message', null);
        }
        ?>
    </div>
    <div class="">
        <h5>Hồ Sơ Của Tôi</h5>
    </div>
    <hr>
    @foreach($get_customer as $c => $customer)
        <form action="">
            @csrf
            <div class="row g-3 align-items-center">
                <div class="col-2">
                <label class="col-form-label">Tên đăng nhập</label>
                </div>
                <div class="col-5">
                    {{ $customer->username }}
                </div>
            </div>

            <br>
            <div class="row g-3 align-items-center">
                <div class="col-2">
                    <label class="col-form-label">Email</label>
                </div>
                <div class="col-3">
                    <input type="text" id="" class="form-control" value="{{ $customer->customer_email }}">
                </div>
            </div>
            <br>
            <div class="row g-3 align-items-center">
                <div class="col-2">
                    <label class="col-form-label">Tên khách hàng</label>
                </div>
                <div class="col-3">
                    <input type="text" id="" class="form-control" value="{{ $customer->customer_name }}">
                </div>
            </div>
            <br>
            <div class="row g-3 align-items-center">
                <div class="col-2">
                    <label class="col-form-label">Số điện thoại</label>
                </div>
                <div class="col-3">
                    <input type="text" id="" class="form-control" value="{{ $customer->customer_phone }}">
                </div>
            </div>
            <button type="button" class="btn btn-warning center">Lưu</button>
        </form>
    @endforeach

    <div class="row">
        <div class="col text-center">
            <ul class="pagination pagination-sm m-t-none m-b-none">
            </ul>
      </div>
    </div>
</div>


@endsection
