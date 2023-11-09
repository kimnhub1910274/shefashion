@extends('all_order')
@section('all_ordered')

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
            <th scope="col">Xác nhận</th>

          </tr>
        </thead>
        <tbody>

            @foreach ( $all_order as $key => $order)
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
                            <span class="text text-danger" >Đã hủy</span>
                            <p style="font-size:12px;">Lý do: {{ $order->order_cancel }}</p>
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
                    <td>
                        @if ($order->order_status == 0)
                            <div style="margin-top: 10px; margin-bottom: -12px;">
                            <form action="">
                                @csrf
                                <button class="btn btn-success" id="{{$order->order_code}}"
                                style="margin-left: -20px;" onclick="acceptorder(this.id)" >Duyệt</button>
                            </form>
                            <form action="">
                                @csrf
                                <button class="btn btn-danger" id="{{$order->order_code}}"
                                    style="margin-left: 50px; margin-top: -67px;"
                                     onclick="cancelorder(this.id)">Hủy</button>
                            </form>
                            </div>

                        @endif
                    </td>
                </tr>
            @endforeach

        </tbody>
      </table>
</div>

@endsection
