@extends('admin_dashboard')
@section('admin_content')

<dir>
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
</dir>
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
    <table class="table">
        <thead>
          <tr>
            <th scope="col">STT</th>
            <th>Mã khách hàng</th>
            <th scope="col">Tên khách hàng</th>
            <th scope="col">Số điện thoại</th>
            <th scope="col">Email</th>
            <th scope="col">Địa chỉ</th>
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
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">

                            </label>
                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
      </table>
</div>

@endsection
