@extends('admin_dashboard')
@section('admin_content')
<div>
    <form action="{{URL::to('/search_access')}}" method="POST" style="float: right"
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
    <h3>DANH SÁCH PHÂN QUYỀN </h3>
    <?php
    $message = Session::get('message');
    if($message){
        echo $message;
        Session::pull('message', null);
    }
    ?>
    <table class="table" style="margin-top: 20px">
        <thead>
          <tr>
            <th scope="col">STT</th>
            <th>Mã </th>
            <th scope="col">Tên </th>
            <th scope="col">Số điện thoại</th>
            <th scope="col">Email</th>
            <th scope="col">Quản trị viên</th>
            <th scope="col">Biên tập viên</th>
            <th scope="col">Người kiểm duyệt</th>
            <th scope="col">Cấp quyền</th>

          </tr>
        </thead>
        <tbody>
            <?php $key =1; ?>
            @foreach($admin as $key => $value)
            <form action="{{ url('/assign-roles') }}" method="POST">
                @csrf
                <tr>
                    <th scope="" ><?php echo $key+1;?></th>
                    <td>{{ $value->admin_id }}</td>
                    <td>{{ $value->admin_name }}</td>
                    <td>{{ $value->admin_phone }}</td>
                    <td>{{ $value->admin_email }}
                        <input type="hidden" name="admin_email" value="{{ $value->admin_email }}">
                        <input type="hidden" name="admin_id" value="{{ $value->admin_id }}">
                    </td>
                    <td>
                        <input type="checkbox" name="admin_role" {{ $value->hasRole('admin') ? 'checked' : '' }}>
                    </td>
                    <td>
                        <input type="checkbox" name="editor_role" {{ $value->hasRole('editor') ? 'checked' : '' }}>
                    </td>
                    <td>
                        <input type="checkbox" name="censor_role" {{ $value->hasRole('censor') ? 'checked' : '' }}>
                    </td>
                    <td>
                        <input type="submit" value="Phân quyền" class="btn btn-success">
                        <a href="{{ url('/delete-roles/'.$value->admin_id) }}" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
            </form>
            @endforeach


        </tbody>
      </table>
</div>

@endsection