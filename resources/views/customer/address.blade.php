@extends('customer')
@section('customer')
<title>Trang người dùng</title>
<div class="" style="margin-top:100px; margin-bottom:100px;">
    <div class="container" >
        &nbsp;
        <?php
        $message = Session::get('message');
        if($message){
            echo $message;
            Session::pull('message', null);
        }
        ?>
    </div>
    <div class="row">
        <h5 class="col">Địa Chỉ Của Tôi</h5>
        <button class="btn btn-outline-primary col-3">Thêm địa chỉ</button>
    </div>
    <hr>
    @foreach($get_address as $a => $address)
            <div class="card ">
                <div class="card-body row">
                   <div class="col-6">
                    {{ $address->name }} | {{ $address->phone }}
                    <br>
                    {{ $address->address }}
                   </div>
                   <div class="col-6 " style="text-align: right;" >
                    <a href="" style="text-decoration:none">Cập nhật</a>
                    <a href="" style="text-decoration:none">Xóa</a>

                    <br>
                    <div class="form-check " style="float: right;" >
                        <label class="form-check-label" for="flexRadioDefault1">
                            <a href="" style="text-decoration:none">Chọn</a>
                          </label>
                          <input class="form-check-input" type="radio" value="" id="flexCheckDefault">
                      </div>
                   </div>
                </div>
            </div>
        <div class="row">
            <div class="col text-center">
                <ul class="pagination pagination-sm m-t-none m-b-none">
                </ul>
        </div>
        </div>
    @endforeach

</div>


@endsection
