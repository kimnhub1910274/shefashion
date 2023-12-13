@extends('customer')
@section('customer')
<title>Trang người dùng</title>
<div class="" >
    <div class="container" style="margin-top:-120px; margin-bottom:100px;">
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
        <form action="{{ URL::to('/edit-infor/'.$customer->customer_id) }}" method="post">
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
                    <input type="text" name="email" class="  form-control" value="{{ $customer->customer_email }}">
                </div>
            </div>
            <br>
            <div class="row g-3 align-items-center">
                <div class="col-2">
                    <label class="col-form-label">Tên khách hàng</label>
                </div>
                <div class="col-3">
                    <input type="text" name="name" class="form-control name" value="{{ $customer->customer_name }}">
                </div>
            </div>
            <br>
            <div class="row g-3 align-items-center">
                <div class="col-2">
                    <label class="col-form-label">Số điện thoại</label>
                </div>
                <div class="col-3">
                    <input type="text" name="phone" class="form-control phone" value="{{ $customer->customer_phone }}">
                </div>
            </div>
            <br>
            <input type="hidden" name="customer_id" id="" class="customer_id" value="{{ $customer->customer_id }}">
            <div class="row g-3 align-items-center">
                <div class="col-5">
                    <button type="submit" class="form-control">Lưu</button>
                </div>
            </div>
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
