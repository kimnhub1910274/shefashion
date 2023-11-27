@extends('admin_dashboard')
@section('admin_content')

<div>
    <form action="{{URL::to('/search_customer')}}" method="POST" style="float: right"
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
<div class="container-fluid card">
    &nbsp;
    <h3>DANH SÁCH KHÁCH HÀNG </h3>
    <?php
    $message = Session::get('message');
    if($message){
        echo $message;
        Session::pull('message', null);
    }
    ?>
    <div id="notify_customer"></div>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">STT</th>
            <th>Mã khách hàng</th>
            <th scope="col">Tên khách hàng</th>
            <th scope="col">Số điện thoại</th>
            <th scope="col">Email</th>
            <th scope="col">Địa chỉ</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Chặn khách hàng</th>

          </tr>
        </thead>
        <tbody>

            @foreach ( $list_customer as $key => $customer)
                <tr>
                    <th scope="" ><?php echo $key+1;?></th>
                    <td>{{$customer->customer_id}}</td>
                    <td>{{$customer->customer_name}}</td>
                    <td>{{$customer->customer_phone}}</td>
                    <td>{{$customer->customer_email}}</td>
                    <td>{{$customer->customer_address}}</td>
                    <td>
                        @if($customer->customer_status == 1)
                            Cho phép
                        @elseif($customer->customer_status == 0)
                            Bị chặn
                        @endif
                    </td>
                    <td>
                        @if ($customer->customer_status == 0)
                            <input type="button" data-customer_id = "{{$customer->customer_id}}"
                            data-customer_status = "1"

                            class="btn btn-success btn-xs btn_customer_status" value="Bỏ chặn">
                        @elseif($customer->customer_status == 1)
                            <input type="button" data-customer_id = "{{$customer->customer_id}}"
                            data-customer_status = "0"

                            class="btn btn-danger btn-xs btn_customer_status" value="Chặn">
                        @endif
                    </td>
                </tr>
            @endforeach

        </tbody>
      </table>
</div>

@endsection
