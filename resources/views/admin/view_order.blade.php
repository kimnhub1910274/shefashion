@extends('admin_dashboard')
@section('admin_content')
<title>Chi tiết đơn hàng</title>
<div class="container-fluid">

    <div class="container-fluid">
      <!-- Title -->
      <div class="d-flex justify-content-between align-items-center py-3">
        <h3 class="h mb-0"><a href="#" class="text-muted"></a> CHI TIẾT ĐƠN HÀNG </h3>
      </div>

      <!-- Main content -->
      <div class="row">
            <div class="col-lg-8">
            <!-- Details -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-3 d-flex justify-content-between">
                            <div>
                                <span class="me-3"></span>
                                <span class="me-3">
                                    @foreach ($order as $key => $valu)
                                        @if ($valu->order_status == 0)
                                            <form action="" method="post">
                                                @csrf
                                                <select name="order_status" id="" class="form-control order_details">
                                                    <option selected value="0" id="{{$valu->order_id}}">
                                                        Đã đặt hàng</option>
                                                    <option value="1" id="{{$valu->order_id}}">
                                                        Đơn hàng đang được xử lý</option>
                                                    <option value="2" id="{{$valu->order_id}}">
                                                        Đơn hàng đang được giao</option>
                                                    <option value="3" id="{{$valu->order_id}}">
                                                        Giao hàng thành công</option>
                                                    <option value="4" id="{{$valu->order_id}}">
                                                        Giao hàng không thành công</option>
                                                </select>
                                            </form>
                                            @elseif($valu->order_status == 1)
                                            <form action="" method="post">
                                                @csrf
                                                <select name="order_status" id="" class="form-control order_details">
                                                    <option  value="0" id="{{$valu->order_id}}">
                                                        Đã đặt hàng</option>
                                                    <option selected value="1" id="{{$valu->order_id}}">
                                                        Đơn hàng đang được xử lý</option>
                                                    <option value="2" id="{{$valu->order_id}}">
                                                        Đơn hàng đang được giao</option>
                                                    <option value="3" id="{{$valu->order_id}}">
                                                        Giao hàng thành công</option>
                                                    <option value="4" id="{{$valu->order_id}}">
                                                        Giao hàng không thành công</option>
                                                </select>
                                            </form>
                                            @elseif($valu->order_status == 2)
                                            <form action="" method="post">
                                                @csrf
                                                <select name="order_status" id="" class="form-control order_details">
                                                    <option  value="0" id="{{$valu->order_id}}">
                                                        Đã đặt hàng</option>
                                                    <option  value="1" id="{{$valu->order_id}}">
                                                        Đơn hàng đang được xử lý</option>
                                                    <option selected value="2" id="{{$valu->order_id}}">
                                                        Đơn hàng đang được giao</option>
                                                    <option value="3" id="{{$valu->order_id}}">
                                                        Giao hàng thành công</option>
                                                    <option value="4" id="{{$valu->order_id}}">
                                                        Giao hàng không thành công</option>
                                                </select>
                                            </form>
                                            @elseif($valu->order_status == 3)
                                            <form action="" method="post">
                                                @csrf
                                                <select name="order_status" id="" class="form-control order_details">
                                                    <option  value="0" id="{{$valu->order_id}}">
                                                        Đã đặt hàng</option>
                                                    <option  value="1" id="{{$valu->order_id}}">
                                                        Đơn hàng đang được xử lý</option>
                                                    <option  value="2" id="{{$valu->order_id}}">
                                                        Đơn hàng đang được giao</option>
                                                    <option selected value="3" id="{{$valu->order_id}}">
                                                        Giao hàng thành công</option>
                                                    <option value="4" id="{{$valu->order_id}}">
                                                        Giao hàng không thành công</option>
                                                </select>
                                            </form>
                                            @elseif($valu->order_status == 4)
                                            <form action="" method="post">
                                                @csrf
                                                <select name="order_status" id="" class="form-control order_details">
                                                    <option  value="0" id="{{$valu->order_id}}">
                                                        Đã đặt hàng</option>
                                                    <option  value="1" id="{{$valu->order_id}}">
                                                        Đơn hàng đang được xử lý</option>
                                                    <option  value="2" id="{{$valu->order_id}}">
                                                        Đơn hàng đang được giao</option>
                                                    <option  value="3" id="{{$valu->order_id}}">
                                                        Giao hàng thành công</option>
                                                    <option selected value="4" id="{{$valu->order_id}}">
                                                        Giao hàng không thành công</option>
                                                </select>
                                            </form>
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
                                            <img src="https://www.bootdey.com/image/280x280/87CEFA/000000"
                                            alt="" width="35" class="img-fluid">
                                            </div>
                                            <div class="flex-lg-grow-1 ms-3">
                                            <h5 class="small mb-0"><a href="#" class="text-reset">
                                                </a>{{ $details->product_name}}</h5>
                                            </div>
                                        </div>
                                    </td>

                                    <td>

                                        <input {{ $order_status == 3 ? 'disabled' : '' }}
                                            type="" min="1"  class="order_qty_{{ $details->product_id }}"
                                            name="product_sale_quantity" style="width:40px"
                                            value="{{ $details->product_quantity}}">

                                        <input type="hidden" name="order_check_quantity"
                                            value="{{$details->product_id}}" class="order_product_id">

                                        <input type="hidden" name="order_id"
                                            value="{{$details->order_id}}" class="order_id">

                                        <input type="hidden" name="order_qty_storage"
                                            value="{{$details->product_quantity}}"
                                            class="order_qty_storage_{{ $details->product_id }}">
                                        {{-- @if ($order_status != 3)
                                            <button class="btn btn-success update_quantity_order"
                                            name="update_quantity_order"
                                            data-product_id="{{ $details->product_id }}">Cập nhật</button>
                                        @endif --}}
                                    </td>
                                    <td class="text">
                                        {{number_format($details->product_price)}}
                                    </td>
                                    <td class="text-end">
                                        {{number_format($subtotal)}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="" colspan="3">Phí vận chuyển</th>
                                    <td class="text-end">0</td>
                                </tr>
                                <tr class="fw-bold">
                                    <td colspan="3">Tổng tiền</td>
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
                    <div class="col-lg-6">
                    <h3 class="h6">Phương thức thanh toán</h3>
                    <p>Thanh toán khi nhận hàng <br>
                    </div>
                    <div class="col-lg-6">
                    <h3 class="h6">Người đặt đơn</h3>
                    <address>
                        <strong>{{ $customer->customer_name}}</strong><br>
                        {{ $customer->customer_address}}
                       <br>
                       {{ $customer->customer_email}} <br>
                        <abbr title="Phone">{{ $customer->customer_phone}}</abbr>
                    </address>
                    </div>
                </div>
                </div>
            </div>
            </div>
        <div class="col-lg-4">
          <!-- Customer Notes -->
          <div class="card mb-4">
            <div class="card-body">
              <h3 class="h6">Ghi chú của khách hàng</h3>
              <p>{{ $ship->ship_note}}</p>
            </div>
          </div>
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
            <!-- Shipping information -->
            <div class="card-body">
              <h3 class="h6">Xuất hóa đơn</h3>
              @foreach ($order as $key => $val)
              @endforeach
              <a target="_blank" href="{{url('/print-order/'.$val->order_id)}}">In đơn hàng</a>
            </div>
          </div>
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
