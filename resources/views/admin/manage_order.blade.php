@extends('admin_dashboard')
@section('admin_content')

<div class="container-fluid card">
    &nbsp;
    <h3>DANH SÁCH ĐƠN HÀNG </h3>
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
            <th scope="col">Tổng tiền  </th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Ngày đặt</th>
            <th scope="col">Hiển thị</th>

          </tr>
        </thead>
        <tbody>

            @foreach ( $all_order as $key => $order)
                <tr>
                    <th scope="" ><?php echo $key+1;?></th>
                    <td>{{$order->order_id}}</td>
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
                        <a href="{{URL::to('/view-order/'.$order->order_id)}}" style="text-decoration: none">
                            <i class="fa-regular fa-eye"style="color: black;"></i>
                        </a>
                        &nbsp;
                    </td>



                </tr>
            @endforeach

        </tbody>
      </table>
</div>

@endsection
