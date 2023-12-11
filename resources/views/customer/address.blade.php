@extends('customer')
@section('customer')
<title>Trang người dùng</title>
<div class="" style="margin-top:-20px; margin-bottom:100px;">
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
        <h5 class="col">Địa Chỉ Của Tôi ({{ $address_count }})</h5>
        <button type="button" class="btn btn-outline-primary col-3" onclick=""
        data-bs-toggle="modal" data-bs-target="#myModal">Thêm địa chỉ</button>
        <!-- The Modal -->
        <div class="modal" id="myModal" style="margin-top: 100px">
        <div class="modal-dialog">
            <form action="">
                @csrf
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h6 class="modal-title" style="text-align:center;" ><b>THÊM ĐỊA CHỈ GIAO HÀNG</b></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <?php
                        $customer_id = Session::get('customer_id');

                    ?>
                    <input type="hidden" name="id_customer" value="{{ $customer_id}}"
                     class="id_customer ">
                     <input type="hidden" name="address_count" value="{{ $address_count}}"
                     class="address_count ">
                    <div class="mb-3 input-group">
                        <span class="input-group-text" id="basic-addon1">Tên</span>
                        <input type="text" name="name" id="" class="name form-control" placeholder="Tên người nhận">
                    </div>
                    <div class="mb-3 input-group">
                        <span class="input-group-text" id="basic-addon1">Số điện thoại</span>
                        <input type="text" name="phone" id="" class="phone form-control" placeholder="Số điện thoại">
                    </div>
                    <div class="mb-3 input-group">
                        <span class="input-group-text" id="basic-addon1">Địa chỉ</span>
                        <textarea type="text" name="location" id=""
                        class="location form-control" placeholder="Địa chỉ nhận hàng"></textarea>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Đóng</button>
                    <button type="button" id=""
                         class="btn btn-primary add-addess">Gửi</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    </div>
    <hr>
    @foreach($get_address as $a => $address)
            <div class="card ">
                <div class="card-body row">
                   <div class="col-6">
                    {{ $address->name }} | {{ $address->phone }}
                    <br>
                    {{ $address->locate}}
                   </div>
                   <div class="col-6 " style="text-align: right;" >
                    <a href="{{ URL::to('/delete-address/'.$address->id_address) }}" style="text-decoration: none">Xóa</a>
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
    <div style="float: right">{{ $get_address->links() }}</div>

</div>


@endsection
