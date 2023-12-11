@extends('user')
@section('ordered')
<title>Lịch sử đơn hàng</title>
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
              <tr style="background-color: pink">
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

                @foreach ( $get_order as $key => $order)
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
                            <a href="{{URL::to('/view-ordered/'.$order->order_code)}}"
                                style="text-decoration: none; color: #000;"> Xem</a>
                        </td>
                        <td>
                            @if ($order->order_status == 0)
                                    <button type="button" class="btn btn-danger" onclick=""
                                    data-bs-toggle="modal" data-bs-target="#myModal">
                                    Hủy
                                    </button>

                                    <!-- The Modal -->
                                    <div class="modal" id="myModal" style="margin-top: 100px">
                                    <div class="modal-dialog">
                                        <form action="">
                                            @csrf
                                            <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h6 class="modal-title">Lý do hủy đơn hàng</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <textarea class="reason_cancel" name="" id="" cols="45"
                                                rows="5" placeholder=" Lý do ... (bắt buộc)"></textarea>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Đóng</button>
                                                <button type="button" id="{{$order->order_code}}"
                                                    onclick="Cancelorder(this.id)" class="btn btn-primary">Gửi</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach

            </tbody>
          </table>
          <div>{{ $get_order->links() }}</div>
    </div>
    <div class="row">
        <div class="col text-center">
            <ul class="pagination pagination-sm m-t-none m-b-none">
            </ul>
      </div>
    </div>
</div>


@endsection
