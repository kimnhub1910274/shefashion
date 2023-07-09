<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
     crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
     integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
     crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
     integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
     crossorigin="anonymous"></script>

</head>
<body>
    <div class="container" style="margin-left: 20%; text-align: justify;">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6" style="margin-left: 10%;">
                    <h4 style="margin-left: 20px;">SHE - FASHION</h4>
                <h4>Chuyên bán quần áo nữ các loại</h4>
                </div>
                <div class="col-md-6">
                    <p>Chào bạn, <strong>{{ $ship_array['customer_name'] }}</strong></p>
                </div>
                <div class="col-md-12">
                    <p>Đơn hàng <b>{{ $ordercode_mail['order_code'] }}</b> được giao thành công , hãy truy cập <a href="http://localhost/shefashion/">website</a> để tiếp tục mua sắm.</p>
                    <div class="row">
                        <div class="col">
                            <h4>THÔNG TIN NGƯỜI MUA</h4>
                            <p >Mã đơn hàng: <b style="color: orange">{{ $ordercode_mail['order_code'] }}</b></p>
                            <p>Ngày đặt hàng: {{ $ordercode_mail['created_at'] }}</p>
                            <p>Người đặt hàng: {{ $ship_array['customer_name'] }}</p>
                            <p>Email: {{ $ordercode_mail['customer_email'] }}</p>
                            <p>Số điện thoại: {{ $ordercode_mail['customer_phone'] }}</p>
                            <p>Địa chỉ: {{ $ordercode_mail['customer_address'] }}</p>

                        </div>
                        <div class="col">
                            <h4>THÔNG TIN NGƯỜI NHẬN</h4>
                            <p>Người nhận hàng: {{ $ship_array['ship_name'] }}</p>
                            <p>Email:

                            </p>
                            <p>Số điện thoại:
                                @if ($ship_array['ship_phone'] == '')
                                Không có
                            @else
                                <span>{{$ship_array['ship_phone']}}</span>
                            @endif
                            </p>
                            <p>Địa chỉ:
                                @if ($ship_array['ship_address'] == '')
                                Không có
                            @else
                                <span>{{$ship_array['ship_address']}}</span>
                            @endif
                            </p>
                            <p>Ghi chú:
                                @if ($ship_array['ship_note'] == '')
                                Không có
                            @else
                                <span>{{$ship_array['ship_note']}}</span>
                            @endif
                            </p>
                        </div>
                    </div>
                    <h4>THÔNG TIN ĐƠN HÀNG</h4>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="">Tên sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Thành tiền</th>

                          </tr>
                        </thead>
                        <tbody>
                            @php
                                $sub = 0;
                                $total = 0;
                            @endphp
                            @foreach($cart_array as $key => $cart)
                                @php
                                    $sub = $cart['product_quantity'] * $cart['product_price'];
                                    $total = $total + $sub;
                                @endphp

                                <tr>
                                    <td>{{ $cart['product_name'] }}</td>
                                    <td>{{ $cart['product_quantity'] }}</td>
                                    <td>{{ number_format( $cart['product_price'],0,',','.') }}</td>
                                    <td>{{ number_format( $sub,0,',','.') }} VNĐ</td>
                                </tr>
                          @endforeach
                        </tbody>
                        <tr>
                            <td colspan="4" >TỔNG TIỀN: <b>{{ number_format( $total,0,',','.')}} VNĐ</b></td>
                        </tr>
                      </table>
                </div>
                <div>
                    <p>Mọi chi tiết thắc mắc xin vui lòng liên hệ: 0795484345</p>
                    <p>Xin cảm ơn</p>
                    <p style="margin-left: 20px;">Đây là email tự động. Vui lòng không trả email này.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
