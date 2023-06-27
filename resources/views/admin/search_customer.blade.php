@extends('admin_dashboard')
@section('admin_content')

<div class="container-fluid">
    <h3>KẾT QUẢ TÌM KIẾM </h3>
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
            <th scope="col">Mã</th>
            <th scope="col">Tên </th>
            <th scope="col">Email</th>
            <th scope="col">Số điện thoại</th>
            <th scope="col">Địa chỉ </th>
          </tr>
        </thead>
        <tbody>
            @foreach ( $search_customer as $key => $customer)
                <tr>
                    <th scope="" ><?php echo $key+1;?></th>
                    <td>{{$customer->customer_id}}</td>
                    <td>{{$customer->customer_name}}</td>
                    <td>{{$customer->customer_email}}</td>
                    <td>{{$customer->customer_phone}}</td>
                    <td>
                        {{$customer->customer_address}}
                    </td>
                </tr>
            @endforeach

        </tbody>
      </table>
</div>
@endsection
