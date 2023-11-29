@extends('admin_dashboard')
@section('admin_content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
 rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
  crossorigin="anonymous">
<div class="card container-sm" style="width:50%">
    &nbsp;
    <div class="">
        <?php
            $message = Session::get('message');
            if($message){
                echo $message;
                Session::pull('message', null);
            }
        ?>
        <section class="panel">
            <header class="text-center panel-heading">
                <h3>THÊM DANH NGƯỜI QUẢN TRỊ</h3>

            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form action="{{URL::to('/store-users')}}" method="post" enctype='multipart/form-data'
                     name="add_permission">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label  class="form-label"><b>Tên</b></label>
                            <input type="text" class="form-control"
                             name="admin_name" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label  class="form-label"><b>Email</b></label>
                            <input class="form-control" id="ckeditor2" style="resize:none;"
                             name="admin_email" ></input>
                        </div>
                        <div class="mb-3">
                            <label  class="form-label"><b>Số điện thoại</b></label>
                            <input class="form-control" style="resize:none;"
                             name="admin_phone" ></input>
                        </div>
                        <div class="mb-3">
                            <label  class="form-label"><b>Mật khẩu</b></label>
                            <input type="password" class="form-control"
                             name="admin_password" placeholder="">
                        </div>
                       <div class="row">
                            <div class="col">
                                <br>
                                <label for=""></label>
                                <button class="add btn btn-primary"  type="submit"
                                 name="add-cate-pro">Thêm</button>
                                 <br>
                                 <div></div>
                            </div>
                       </div>
<style>

    button.add.btn.btn-primary {
        margin-top: 8px;
    }

</style>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>


@endsection
