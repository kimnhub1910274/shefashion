@extends('user')
@section('ordered')
<title>Lịch sử đơn hàng</title>
<div class="container" style="margin-top: 220px;">
    <div class="container card" style="margin-top: 120px">
        &nbsp;
        <?php
        $message = Session::get('message');
        if($message){
            echo $message;
            Session::pull('message', null);
        }
        ?>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">STT</th>
                <th>Mã đơn hàng</th>
                <th>Mã khách hàng</th>
                <th scope="col">Tổng tiền</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Ngày đặt</th>
                <th scope="col">Hiển thị</th>

              </tr>
            </thead>
            <tbody>

                @foreach ( $get_order as $key => $order)
                    <tr>
                        <th scope="" ><?php echo $key+1;?></th>
                        <td>{{$order->order_code}}</td>
                        <td>{{$order->customer_id}}</td>
                        <td>{{number_format($order->order_total)}}</td>
                        <td>
                            @if ($order->order_status == 0)
                                Đã đặt hàng
                            @elseif($order->order_status == 1)
                                Đơn hàng đang xử lý
                            @elseif($order->order_status == 2)
                                Đơn hàng đang được giao
                            @elseif($order->order_status == 3)
                                Giao hàng thành công
                            @elseif($order->order_status == 4)
                                Giao hàng không thành công
                            @endif
                            </td>
                        <td>{{$order->created_at}}</td>
                        <td>
                            <a href="{{URL::to('/view-ordered/'.$order->order_code)}}" style="text-decoration: none">
                                Xem chi tiết
                            </a>
                            &nbsp;

                        </td>



                    </tr>
                @endforeach

            </tbody>
          </table>
    </div>
    <div class="row">
        <div class="col text-center">
            <ul class="pagination pagination-sm m-t-none m-b-none">
            </ul>
      </div>
    </div>
</div>


@endsection
