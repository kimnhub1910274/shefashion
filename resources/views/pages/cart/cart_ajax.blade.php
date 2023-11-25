@extends('test')
@section('test')
<title>Giỏ hàng</title>
<div class="container" style="margin-bottom: 30px; margin-top: 120px;">
    <?php
        $ship_id = Session::get('ship_id');
        $customer_id = Session::get('customer_id');

        ?>
        <br>
        <?php
        $message = Session::get('message');
        if($message){
            echo $message;
            Session::pull('message', null);
        }
    ?>
        <div class="card">
            <div class="card-header">
                <h4>GIỎ HÀNG</h4>
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
                                        <form action="{{ URL::to('/update-quantity-cart') }}" method="post"
                                            style="margin-left: ;margin-top: ">
                                            {{@csrf_field() }}
                                            <input type="hidden" value="{{$cart['product_id']}}">
                                            <input style="width:50px;" type="number"
                                                name="cart_qty[{{ $cart['session_id'] }}]"
                                                value="{{ $cart['product_qty'] }}" min="1" class="cart_quantity">
                                            <button type="submit" class="btt">Cập nhật</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ URL::to('/update-size-cart') }}" method="post">
                                            @csrf
                                            @if($cart['product_size'] == 1)
                                                <select name="cart_size" id="{{ $cart['session_id'] }}" class="form-control cart_size" >

                                                    <option selected value="1" id="{{ $cart['product_size'] }}">
                                                        S</option>
                                                    <option value="2" id="{{ $cart['product_size'] }}">
                                                        M</option>
                                                    <option value="3" id="{{ $cart['product_size'] }}">
                                                        L</option>
                                                    <option value="4" id="{{ $cart['product_size'] }}">
                                                        XL</option>

                                                </select>
                                                <input type="hidden" name="cart_session_id"
                                                        id="{{ $cart['session_id'] }}" class="">
                                            @elseif($cart['product_size'] == 2)
                                                    <select name="cart_size" id="{{ $cart['session_id'] }}" class="form-control cart_size" >
                                                        <option  value="1" id="{{ $cart['product_size'] }}">
                                                            S</option>
                                                        <option selected value="2" id="{{ $cart['product_size'] }}">
                                                            M</option>
                                                        <option value="3" id="{{ $cart['product_size'] }}">
                                                            L</option>
                                                        <option value="4" id="{{ $cart['product_size'] }}">
                                                            XL</option>

                                                    </select>
                                                    <input type="hidden" name="cart_session_id"
                                                        id="{{ $cart['session_id'] }}" class="cart_session_id">
                                            @elseif($cart['product_size'] == 3)
                                                <select name="cart_size" id="{{ $cart['session_id'] }}" class="form-control cart_size " >
                                                    <option  value="1" id="{{ $cart['product_size'] }}">
                                                        S</option>
                                                    <option  value="2" id="{{ $cart['product_size'] }}">
                                                        M</option>
                                                    <option selected value="3" id="{{ $cart['product_size'] }}">
                                                        L</option>
                                                    <option value="4" id="{{ $cart['product_size'] }}">
                                                        XL</option>

                                                </select>
                                                <input type="hidden" name="cart_session_id"
                                                        id="{{ $cart['session_id'] }}" class="cart_session_id">
                                            @elseif($cart['product_size'] == 4)
                                                    <select name="cart_size" id="{{ $cart['session_id'] }}" class="form-control cart_size" >
                                                        <option  value="1" id="{{ $cart['product_size'] }}">
                                                            S</option>
                                                        <option  value="2" id="{{ $cart['product_size'] }}">
                                                            M</option>
                                                        <option value="3" id="{{ $cart['product_size'] }}">
                                                            L</option>
                                                        <option selected value="4" id="{{ $cart['product_size'] }}">
                                                            XL</option>

                                                    </select>
                                                    <input type="hidden" name="cart_session_id"
                                                        id="{{ $cart['session_id'] }}" class="cart_session_id">
                                            @endif
                                            <button type="submit" class="btt">Cập nhật</button>
                                        </form>

                                    </td>
                                    <td>
                                        <form action="" method="post">
                                            @csrf
                                            @if($cart['product_color'] == 1)
                                                <select name="" id="" class="form-control " name="cart_color">
                                                    <option selected value="1" id="{{ $cart['product_color'] }}">
                                                        Vàng</option>
                                                    <option value="2" id="{{ $cart['product_color'] }}">
                                                        Trắng</option>
                                                    <option value="3" id="{{ $cart['product_color'] }}">
                                                        Hồng</option>
                                                    <option value="4" id="{{ $cart['product_color'] }}">
                                                        Xanh</option>

                                                </select>
                                            @elseif($cart['product_color'] == 2)
                                                    <select name="" id="" class="form-control " name="cart_color">
                                                        <option  value="1" id="{{ $cart['product_color'] }}">
                                                            Vàng</option>
                                                        <option selected value="2" id="{{ $cart['product_color'] }}">
                                                            Trắng</option>
                                                        <option value="3" id="{{ $cart['product_color'] }}">
                                                            Hồng</option>
                                                        <option value="4" id="{{ $cart['product_color'] }}">
                                                            Xanh</option>

                                                    </select>
                                            @elseif($cart['product_color'] == 3)
                                                <select name="" id="" class="form-control " name="cart_color">
                                                    <option  value="1" id="{{ $cart['product_color'] }}">
                                                        Vàng</option>
                                                    <option  value="2" id="{{ $cart['product_color'] }}">
                                                        Trắng</option>
                                                    <option selected value="3" id="{{ $cart['product_color'] }}">
                                                        Hồng</option>
                                                    <option value="4" id="{{ $cart['product_color'] }}">
                                                        Xanh</option>

                                                </select>
                                            @elseif($cart['product_color'] == 4)
                                                    <select name="" id="" class="form-control " name="cart_color">
                                                        <option  value="1" id="{{ $cart['product_color'] }}">
                                                            Vàng</option>
                                                        <option  value="2" id="{{ $cart['product_color'] }}">
                                                            Trắng</option>
                                                        <option value="3" id="{{ $cart['product_color'] }}">
                                                            Hồng</option>
                                                        <option selected value="4" id="{{ $cart['product_color'] }}">
                                                            Xanh</option>

                                                    </select>
                                            @endif
                                            <button type="submit" class="btt">Cập nhật</button>
                                        </form>
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
                                <td colspan="5" class="text-center"><b>{{ number_format($total) }} VNĐ</b></td>
                                <td colspan="4">
                                    <a href="{{ URL::to('/delete-all-cart') }}" class="btn btn-danger"
                                        style="float:right;">Xóa tất cả</a>
                                </td>
                            </tr>
                            @else
                            <p class="text-center"><b>Giỏ hàng rỗng hãy mua sắm</b></p>
                            @endif

                        </tbody>
                </table>
                <h5 >
                    <?php
                        $customer_id = Session::get('customer_id');
                        $ship_id = Session::get('ship_id');
                        if($customer_id == null ) {
                    ?>
                            <p class="text-center" style="color: red" > Hãy đăng nhập để mua sắm. </p>
                            <a href="{{ URL::to('/login-checkout') }}" class="btn btn-success"
                             style="float:right ; background-color: rgb(143, 10, 10); color:white;"><b>ĐẶT HÀNG</b></a>
                    <?php
                        }else {
                    ?>

                    <a href="{{ URL::to('/check-out') }}" class="btn btn-success"
                     style="float:right ; background-color: rgb(143, 10, 10); color:white;"><b>ĐẶT HÀNG</b></a>
                    <?php
                        }
                    ?>
                </h5>
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
