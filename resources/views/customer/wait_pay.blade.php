@extends('user')
@section('ordered')
<title>Chờ thanh toán</title>
<div class="" >
    <div class="container card" style="margin-top:170px; margin-bottom:100px;">
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

                <th scope="col">Trạng thái</th>
                <th scope="col">Ngày đặt</th>
                <th scope="col">Hiển thị</th>

              </tr>
            </thead>
            <tbody>

                @foreach ( $wait_pay as $key => $order)
                    <tr>
                        <th scope="" ><?php echo $key+1;?></th>
                        <td>{{$order->order_code}}</td>
                        <td>{{$order->customer_id}}</td>

                        <td>
                            @if ($order->order_status == 0)
                                            Chờ xác nhận
                                            @elseif($order->order_status == 1)
                                            Đơn hàng đã được xử lý
                                            </form>
                                            @elseif($order->order_status == 2)
                                            Đang giao hàng
                                            </form>
                                            @elseif($order->order_status == 3)
                                            Giao hàng thành công
                                            @elseif($order->order_status == 4)
                                            Đã hủy
                                            @elseif($order->order_status == 5)
                                            Giao hàng không thành công
                                        @endif
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
