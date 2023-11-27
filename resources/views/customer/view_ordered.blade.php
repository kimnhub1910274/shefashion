@extends('test')
@section('test')

<title>Chi tiết đơn hàng</title>
<div class="container-fluid">
    <div class="container " style="margin-top: 100px">
      <!-- Title -->
      <div class="d-flex justify-content-between align-items-center py-3">
        <h3 class=" mb-0"><a href="#" class="text-muted"></a> CHI TIẾT ĐƠN HÀNG </h3>
      </div>

      <!-- Main content -->
      <div class="row">
            <div class="col-lg-8">
            <!-- Details -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-3  justify-content-between">
                            <div class="row">
                                <span class=" col-7 " >
                                     @foreach ($order as $key => $valu)
                                        @if ($valu->order_status == 0)
                                            Chờ xác nhận
                                            @elseif($valu->order_status == 1)
                                            Đơn hàng đã được xác nhận
                                            </form>
                                            @elseif($valu->order_status == 2)
                                            Đang giao hàng
                                            </form>
                                            @elseif($valu->order_status == 3)
                                            Giao hàng thành công
                                            @elseif($valu->order_status == 4)
                                            <span class="text text-danger">Đã hủy</span>
                                            @elseif($valu->order_status == 5)
                                            Giao hàng không thành công
                                        @endif
                                    @endforeach
                                </span>
                                <span class="col-5">
                                    @foreach ($order as $key => $valu)
                                        @if($valu->order_status == 4)
                                            <p>Lý do: {{ $valu->order_cancel }}</p>
                                        @endif
                                    @endforeach
                                </span>
                            </div>
                        </div>
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng </th>
                                    <th>Kích cỡ</th>
                                    <th>Màu sắc</th>
                                    <th>Giá</th>

                                    <th>Thành tiền</th>

                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($order_details as $key => $details)
                                @php
                                    $subtotal = $details->product_price * $details->product_quantity;
                                    $total = $subtotal + $total ;
                                @endphp
                                <tr class="error_quantity_{{ $details->product_id }}">
                                    <td>
                                        <div class="d-flex mb-2">
                                            <div class="flex-shrink-0">
                                            <img src="{{ URL::to('public/uploads/product/'.$details->product_image) }}"
                                            alt="" width="35" class="img-fluid">
                                            </div>
                                            <div class="flex-lg-grow-1 ms-3">
                                            <h5 class="small mb-0"><a href="#" class="text-reset">
                                                </a>{{ $details->product_name}}</h5>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        {{ $details->product_quantity}}
                                    </td>
                                    <td>
                                        @if($details->product_size == 1)
                                            S
                                        @elseif($details->product_size == 2)
                                            M
                                        @elseif($details->product_size == 3)
                                            L
                                        @elseif($details->product_size == 4)
                                            XL
                                        @endif
                                    </td>
                                    <td>
                                        @if($details->product_size == 1)
                                            Vàng
                                        @elseif($details->product_size == 2)
                                            Trắng
                                        @elseif($details->product_size == 3)
                                            Hồng
                                        @elseif($details->product_size == 4)
                                            Xanh
                                        @endif
                                    </td>
                                    <td class="text">
                                        {{number_format($details->product_price)}}
                                    </td>
                                    <td class="text">
                                        {{number_format($subtotal)}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="" colspan="5">Phí vận chuyển</th>
                                    <td class="text-end">0</td>
                                </tr>
                                <tr class="fw-bold">
                                    <td colspan="5">Tổng tiền</td>
                                    <td class="text-end">
                                        {{ number_format($total)}}</td>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
            <!-- Payment -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                        <h3 class="h6">Phương thức thanh toán</h3>
                        <p>Thanh toán khi nhận hàng<br>
                        </div>
                        <div class="col-lg-4">
                        <h3 class="h6">Người đặt đơn</h3>
                        <address>
                            <strong>{{ $customer->customer_name}}</strong><br>
                            {{ $customer->customer_address}}
                        <br>
                        {{ $customer->customer_email}} <br>
                            <abbr title="Phone">{{ $customer->customer_phone}}</abbr>
                        </address>
                        </div>
                        <div class="col-lg-4">
                            <h3 class="h6">Ghi chú của khách hàng</h3>
                            <p>{{ $ship->ship_note}}</p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        <div class="col-lg-4">

          <div class="card mb-4">
            <!-- Shipping information -->
            <div class="card-body">
              <h3 class="h6">Thông tin vận chuyển</h3>
              <address>
                <strong>{{ $ship->ship_name}}</strong><br>
                {{ $ship->ship_address}}<br>
                <abbr title="Phone">P:</abbr> {{ $ship->ship_phone}}
              </address>
            </div>
          </div>
          <div class="card mb-4">
            <div class="card-body">
            <h3 class="h6">Chat với người bán</h3>
            <p></p>
            </div>
        </div>
          @foreach ($order as $key => $valu)
            @if ($valu->order_status == 3)
            <div class="card mb-4">
                <!-- Shipping information -->
                <div class="card-body">
                    <h3 class="h6">Đánh giá đơn hàng</h3>
                    <form action="" method="post">

                        @csrf
                        <input type="hidden" class="order_id"
                        name="order_id" id="" value="{{$valu->order_code}}">

                        <input type="hidden" class="customer_id"
                        name="customer_id" id="" value="{{$valu->customer_id}}">

                        <div class="" id="order_review"  ></div>

                    </form>
                    <form action="" method="post">
                        @csrf
                        <div>
                            <style>
                                ul {
                                    list-style-type: none;
                                    margin: 0;
                                    padding: 0;
                                    overflow: hidden;
                                }

                                li {
                                    float: left;
                                }

                                li a {
                                    display: block;
                                    color: white;
                                    text-align: center;
                                    padding: 16px;
                                    text-decoration: none;
                                }

                                </style>
                            <ul class="list-inline rating">
                                @for ($count = 1; $count<=5; $count++)
                                    @php
                                        if($count <= $rating){
                                            $color = 'color: #ffcc00;';
                                        }else{
                                            $color = 'color: #ccc;';
                                        }
                                    @endphp


                                    <li title="star_rating"
                                        id="{{ $valu->order_code}} - {{$count}}"
                                        data-index="{{ $count }}"
                                        data-order_code="{{ $valu->order_code }}"
                                        data-rating="{{ $rating }}"
                                        class="rating"
                                        style="cursor: pointer;{{ $color }} font-size:30px;" >
                                        &#9733;

                                    </li>
                                @endfor
                            </ul>
                        </div>
                          <div>
                            <textarea name="review" class="form-control review" ></textarea>
                            <input type="hidden" class="order_id" value="{{$valu->order_id}}">
                            <input type="hidden" class="customer_id"
                             name="customer_id" id="" value="{{$valu->customer_id}}">
                          </div>
                          <br>
                          <button type="button" class="btn send-review" style="background-color: rgb(143, 10, 10);
                           color:white;">Đánh giá</button>
                      </form>


                </div>
              </div>
            @endif
          @endforeach
        </div>
      </div>
    </div>
      </div>
      <style>
        body{
            background:#eee;
        }
        .card {
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        }
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0,0,0,.125);
            border-radius: 1rem;
        }
        .text-reset {
            --bs-text-opacity: 1;
            color: inherit!important;
        }
        a {
            color: #5465ff;
            text-decoration: none;
        }
      </style>
@endsection
