@extends('all_order')
@section('all_ordered')
<title>Giao hàng thành công</title>
<div class="container-fluid card">
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
            <th scope="col">Trạng thái</th>
            <th scope="col">Ngày đặt</th>
            <th scope="col">Hiển thị</th>

          </tr>
        </thead>
        <tbody>

            @foreach ( $success_delivery as $key => $order)
                <tr>
                    <th scope="" ><?php echo $key+1;?></th>
                    <td>{{$order->order_code}}</td>
                    <td>{{$order->customer_id}}</td>
                    <td>
                        @if ($order->order_status == 0)
                            Chờ xác nhận
                        @elseif($order->order_status == 1)
                            Đơn hàng đã được xác nhận
                        @elseif($order->order_status == 2)
                            Đơn hàng đang được giao
                        @elseif($order->order_status == 3)
                            Giao hàng thành công
                            @elseif($order->order_status == 4)
                            Đã hủy
                        @elseif($order->order_status == 5)
                            Giao hàng không thành công
                        @endif
                        </td>
                    <td>{{$order->created_at}}</td>
                    <td>
                        <a href="{{URL::to('/view-order/'.$order->order_code)}}" style="text-decoration: none">
                            <i class="fa-regular fa-eye"style="color: black;"></i>
                        </a>
                        &nbsp;
                    </td>
                </tr>
            @endforeach

        </tbody>
      </table>
      <div>
        {{ $success_delivery->links() }}
      </div>
</div>

@endsection
