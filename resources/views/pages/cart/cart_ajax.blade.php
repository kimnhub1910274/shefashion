@extends('test')
@section('test')
<title>Giỏ hàng</title>
<div class="container" style="margin-bottom: 30px; margin-top: 120px;">
    <?php
        $ship_id = Session::get('ship_id');
        $customer_id = Session::get('customer_id');
        if($customer_id ) {
        ?>
            <a  href="{{ URL::to('/ordered/'.$customer_id) }}">
                <button class="btn btn-info" style="margin-bottom: 30px;">Xem lịch sử đơn hàng</button>

            </a>
        <?php }
        ?>
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
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Session::get('cart') as $key => $cart)
                            <tr>
                                <td>{{ $cart->['product_id'] }}</td>
                                <td><a href="{{ URL::to('/product-detail/'.$cart->id) }}" >
                                    <img src="{{ URL::to('public/uploads/product/'.$cart['product_image']) }}" width="100" height="100" style="margin-bottom: 5px" alt="">
                                     {{-- {{ $value->name }} --}}
                                    </a>
                                </td>
                                <td>{{$cart['product_name']}}</td>
                                <td>
                                    <span>
                                        <form action="{{ URL::to('/reduce-to-cart') }}" method="post">
                                            {{@csrf_field() }}
                                            <input type="hidden" name="cart_id" value="{{$cart['product_id']  }}">
                                            <button type="submit" class="btt">-</button>
                                        </form>
                                    </span>
                                    <span>
                                        <form action="{{ URL::to('/increase-to-cart') }}" method="post" style="margin-left: 23px;
                                        margin-top: -36px;">
                                            {{@csrf_field() }}
                                            <input type="hidden" name="cart_id" value="{{$cart['product_id']  }}">
                                            <input style="width:50px;" type="text" name="cart_quantity[]" value="{{ $cart['product_quantity'] }}" min="1">
                                            <button type="submit" class="btt">+</button>
                                        </form>
                                    </span>

                                </td>

                                <td>{{ number_format($cart['product_price']) }}</td>
                                <td>{{ number_format($cart['product_price'] * $cart['product_quantity']) }}</td>
                                <td>
                                    <a href="{{ URL::to('/delete-to-cart/'.$cart['product_id']) }}"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>

                        @endforeach
                        <tr>
                            <td><b>TỔNG TIỀN:</b></td>
                            <td colspan="6" class="text-center "><b>{{ number_format(Cart::getTotal()) }} VNĐ</b></td>
                        </tr>


                    </tbody>
                </table>
                <h5 >
                    <?php
                        $customer_id = Session::get('customer_id');
                        $ship_id = Session::get('ship_id');
                        if($customer_id == null ) {
                    ?>
                            <p class="text-center" style="color: red" > Hãy đăng nhập để mua sắm. </p>
                            <a href="{{ URL::to('/login-checkout') }}" class="btn btn-success" style="float:right ;"><b>ĐẶT HÀNG</b></a>
                    <?php
                        }else {
                    ?>

                    <a href="{{ URL::to('/check-out') }}" class="btn btn-success" style="float:right ;"><b>ĐẶT HÀNG</b></a>
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
