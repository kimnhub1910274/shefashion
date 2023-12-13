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
                        <h6>GIỎ HÀNG</h6>
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
                                    $fee = Session::get('fee');

                                @endphp
                                @if($c == true)
                                    @foreach($c as $key => $cart)
                                    @php
                                        $subtotal = $cart['product_price'] * $cart['product_qty'];
                                        $total = $total + $subtotal;
                                        $total_order = $total + $fee;
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
                                    @foreach($customer as $key => $c)
                                        <input type="hidden" class="customer_status"
                                        name="customer_status" value="{{ $c->customer_status }}">
                                    @endforeach
                                    <tr>
                                        <td colspan="3"><b>TỔNG TIỀN:</b></td>
                                        <td colspan="3" class="text-center"><b>{{ number_format($total) }} VNĐ</b></td>
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
                        $customer_status = Session::get('customer_status');

                    ?>
                    <div class="card-body">

                        <form  method="POST">

                            <div class="mb-3 input-group">
                                <input type="hidden" class="form-control customer_id" placeholder=""
                                aria-label="" name="customer_id"
                                aria-describedby="basic-addon1" value="{{ $customer_id }}">
                            </div>
                            <p><b>Địa chỉ:</b></p>
                            <div class="mb-3 input-group">
                                <select name="" id="" class="form-control ship_address" style="height: 80px">
                                    <option value="">Chọn</option>
                                    @foreach ($address as $k => $add)
                                    <option value="{{ $add->name }}-{{ $add->phone }}-{{ $add->locate }}">
                                        {{ $k+1 }}. {{ $add->name }}
                                        {{ $add->phone }}
                                        {{ $add->locate }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="button" class="btn btn-outline-primary col-5" onclick=""
                                style="width:120px; font-size:12px"
                                data-bs-toggle="modal" data-bs-target="#myModal">
                                <span><i class="fas fa-plus-circle"></i></span> Thêm địa chỉ</button>
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
                                            <input type="hidden" name="address_count" value=""
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
                           <p><b>Hình thức thanh toán: </b></p>
                            <div class="mb-3 input-group">
                                <select name="payment_method" id="" class="form-control payment_method">
                                    <option value="1">Thanh toán khi nhận hàng</option>
                                    <option value="2">Thanh toán PayPal</option>
                                </select>
                            </div>
                            <p><b>Ghi chú: </b></p>
                            <div class="mb-3 input-group">
                                <textarea type="text" class="form-control ship_note"
                                placeholder="(Nếu có)" name="ship_note"></textarea>
                            </div>
                            <input type="hidden" class="ship_fee" value="{{ $fee }}" name="" id="">
                        </div>
                           <?php
                                ?>
                                <input type="button" value="ĐẶT HÀNG" class="order btn"
                                style="float: right; background-color: rgb(143, 10, 10);
                                 color:white;" name="order" ></input>
                                <?php
                           ?>
                       </form>
                    </div>
                </div>
                <br>
                <?php
                    $fee = Session::get('fee');
                ?>
                <form action="" method="post" name="delivery">
                    @csrf
                    <div class="row" style="margin-top: 35px">
                        <div class="col" >

                            <div class="mb-3">
                                <label  class="form-label"><b>Chọn tỉnh/thành phố</b>
                                    <span style="color: gray">(Hãy chọn để tính phí vận chuyển)</span>
                                </label>
                                <select class="form-select input-sm choose city" name="city" id="city">
                                    <option value="0">Chọn tỉnh/thành phố</option>
                                    @foreach ($city as $k => $c )
                                    <option value="{{ $c->matp }}">{{ $c->city_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label  class="form-label"><b>Chọn quận/huyện</b></label>
                                <select class="form-select input-sm choose district"  name="district" id="district">
                                    <option value="0">Chọn quận/huyện</option>

                                </select>
                            </div>
                            <div class="mb-3">
                                <label  class="form-label"><b>Chọn xã/phường</b></label>
                                <select class="form-select input-sm ward" name="ward" id="ward">
                                <option value="0">Chọn xã/phường</option>
                                </select>
                            </div>
                            <div class="mb-3">

                            </div>
                            <input type="button" name="fee_ship" id=""
                                class="fee_ship_order btn btn-info"
                                value="Phí vận chuyển">

                        </div>

                        <div class="col">
                            <div class="card" style="margin-top: ">
                                <div class="card-header">
                                    <h6>TÓM TẮT ĐƠN HÀNG</h6>
                                </div>
                                <div class="card-body">
                                    <p class="total_order"><b>Giá trị đơn hàng:
                                        </b> {{ number_format($total + $fee) }} VNĐ</p>
                                    <p><b>Phí giao hàng:</b>
                                        @if ($fee)
                                        {{ number_format($fee) }}
                                        <a href="{{ url('/delete-fee') }}">
                                            <i class="fa fa-times"></i>
                                        </a>
                                        @elseif(!$fee)
                                        {{ number_format(20000) }}
                                        <a href="{{ url('/delete-fee') }}">
                                            <i class="fa fa-times"></i>
                                        </a>
                                        @endif

                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                @php
                                   $money_vn = $total / 24257;
                                @endphp
                                <div id="paypal-button-container">
                                    <input type="hidden" id="money_vn" value="{{ round($money_vn, 2) }}">
                                </div>
                                <p id="result-message"></p>
                            </div>
                        </div>
                    </div>
                </form>
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
