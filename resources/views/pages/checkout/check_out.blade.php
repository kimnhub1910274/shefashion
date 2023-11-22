@extends('test')
@section('test')
<title>Thanh toán</title>
<script type="text/javascript">

</script>
<div class="container" style="margin-bottom: 30px; margin-top:120px;">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Danh sách sản phẩm</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Mã sản phẩm</th>
                                    <th>Ảnh sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Kích cỡ</th>
                                    <th>Màu sắc</th>
                                    <th>Giá</th>
                                    <th>Thành tiền</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    //print_r(Session::get('cart'));
                                    $c = Session::get('cart');
                                    $total = 0;

                                @endphp
                                @if($c == true)
                                    @foreach($c as $key => $cart)
                                    @php
                                        $subtotal = $cart['product_price'] * $cart['product_qty'];
                                        $total = $total + $subtotal;
                                    @endphp
                                        <tr>
                                            <td>{{ $cart['product_id'] }}</td>
                                            <td><a href="" >
                                                <img src="{{asset('public/uploads/product/'.$cart['product_image'])}}"
                                                width="100" height="100" style="margin-bottom: 5px"
                                                alt="{{ $cart['product_name'] }}">
                                                {{-- {{ $value->name }} --}}
                                                </a>
                                            </td>
                                            <td>{{ $cart['product_name'] }}</td>
                                            <td>
                                                {{ $cart['product_qty'] }}</td>
                                                <td>
                                                    @if($cart['product_size'] == 1)
                                                       S
                                                    @elseif($cart['product_size'] == 2)
                                                        M
                                                    @elseif($cart['product_size'] == 3)
                                                        L
                                                    @elseif($cart['product_size'] == 4)
                                                       XL
                                                    @endif

                                                </td>
                                                <td>
                                                    @if($cart['product_color'] == 1)
                                                        Vàng
                                                    @elseif($cart['product_color'] == 2)
                                                        Trắng
                                                    @elseif($cart['product_color'] == 3)
                                                        Hồng
                                                    @elseif($cart['product_color'] == 4)
                                                        Xanh
                                                    @endif

                                                </td>

                                            <td>{{ number_format($cart['product_price']) }}</td>
                                            <td>{{ number_format($subtotal) }}</td>
                                            <td>
                                                <a href="{{URL::to('/delete-to-cart/'.$cart['session_id'])}}">
                                                    <i class="fa-solid fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td><b>TỔNG TIỀN:</b></td>
                                        <td colspan="6" class="text-center"><b>{{ number_format($total) }} VNĐ</b></td>
                                        <td colspan="2">
                                        </td>
                                    </tr>
                                    @else
                                    <p class="text-center"><b>Giỏ hàng rỗng hãy mua sắm</b></p>
                                    @endif

                                </tbody>
                        </table>

                    </div>
                </div>

            </div>
            <div class="col-4 " >
                <div class="card">
                    <div class="card-header">
                        <h6>THÔNG TIN GIAO HÀNG</h6>
                    </div>
                    <?php
                        $customer_id = Session::get('customer_id');
                        $customer_name = Session::get('customer_name');
                        $customer_phone = Session::get('customer_phone');
                        $customer_address = Session::get('customer_address');
                    ?>
                    <div class="card-body">

                        <form  method="POST">

                            <div class="mb-3 input-group">
                                <input type="hidden" class="form-control customer_id" placeholder=""
                                aria-label="" name="customer_id"
                                aria-describedby="basic-addon1" value="{{ $customer_id }}">
                            </div>
                           <div class="mb-3 input-group">
                               <span class="input-group-text" id="basic-addon1">Họ tên</span>
                               <input type="text" class="form-control ship_name" placeholder="" aria-label="" name="ship_name"
                               aria-describedby="basic-addon1" value="{{ $customer_name }}"  >
                           </div>
                           <div class="mb-3 input-group">
                               <span class="input-group-text" id="basic-addon1">Số điện thoại</span>
                               <input type="text" class="form-control ship_phone" placeholder="" aria-label="" name="ship_phone"
                               aria-describedby="basic-addon1" value="{{ $customer_phone }}" >
                           </div>
                           <div class="mb-3 input-group">
                               <span class="input-group-text" id="basic-addon1">Địa chỉ</span>
                               <input type="text" class="form-control ship_address" placeholder="" aria-label=""
                               name="ship_address"
                               aria-describedby="basic-addon1" value="{{ $customer_address }}">
                           </div>
                           <div class="mb-3 input-group">
                               <span class="input-group-text" id="basic-addon1">Ghi chú</span>
                               <textarea type="text" class="form-control ship_note"
                               placeholder="" name="ship_note"></textarea>
                           </div>
                        </div>
                           <?php
                            if ($c == true) {
                                ?>
                                <input type="button" value="ĐẶT HÀNG" class="order btn btn-success"
                                style="float: right" name="order" ></input>
                                <?php
                            }
                           ?>
                       </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h6>TÓM TẮT ĐƠN HÀNG</h6>
                    </div>
                    <div class="card-body">
                        <p><b>Giá trị đơn hàng:</b> {{ number_format($total) }} VNĐ</p>
                        <p><b>Phí giao hàng:</b> Miễn phí</p>
                        <p><b>Hình thức:</b> Thanh toán khi nhận hàng</p>
                    </div>
                </div>
            </div>
            </div>
        </div>
 </div>
 <style>
    .btt{
        bottom: 20px;
        right: 30px;
        z-index: 99;
        font-size: 18px;
        border: none;
        background-color: wheat;
        color: #581a14;
        padding: 5px;
        border-radius: 4px;
    }
</style>


@endsection
