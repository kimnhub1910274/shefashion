@extends('all_order')
@section('all_ordered')

<div>
    <form action="{{URL::to('/search_order')}}" method="POST" style="float: right; "
        class="my-2 mr-auto d-none d-sm-inline-block form-inline ml-md-3 my-md-0 mw-100 navbar-search">
        {{ csrf_field() }}
        <div class="input-group">
            <input type="text"  class="border-0 form-control bg-light small" placeholder="Tìm kiếm"
                aria-label="Search" aria-describedby="basic-addon2" name="key_word">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fa fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>
</div>
<div class="container card" style="margin-top: 20px">
    <?php
    $message = Session::get('message');
    if($message){
        echo $message;
        Session::pull('message', null);
    }
    ?>
    <table class="table ">
        <thead>
          <tr style="background-color: rgb(210, 226, 152)">
            <th scope="col">STT</th>
            <th>Mã đơn hàng</th>
            <th>Mã khách hàng</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Ngày đặt</th>
            <th scope="col">Hiển thị</th>
            <th scope="col">Xác nhận</th>
            <th scope="col">Xóa</th>

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
                                <button class="btn btn-success " id="{{$order->order_code}}"
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
                    <td>
                        <a href="{{URL::to('/delete-order/'.$order->order_code)}}">
                            <i class="delete_order fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
      <div class="" style="margin-left:50%;">
        {{ $all_order->links() }}
      </div>

</div>

@endsection
