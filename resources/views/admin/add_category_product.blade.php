@extends('admin_dashboard')
@section('admin_content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
 rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
  crossorigin="anonymous">
<div class="card">
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
                <h3>THÊM DANH MỤC SẢN PHẨM</h3>

            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form action="{{URL::to('/category-product')}}" method="post" enctype='multipart/form-data'
                     name="add_category">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label  class="form-label"><b>Tên danh mục</b></label>
                            <input type="text" class="form-control"
                             name="cate_pro_name" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label  class="form-label"><b>Mô tả</b></label>
                            <textarea class="form-control" id="ckeditor2" style="resize:none;"
                             name="meta_desc" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label  class="form-label"><b>Từ khóa danh mục</b></label>
                            <textarea class="form-control" style="resize:none;"
                             name="meta_key" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label  class="form-label"><b>Số lượng</b></label>
                            <input type="text" class="form-control"
                             name="cate_pro_quantity" placeholder="">
                        </div>
                       <div class="row">
                            <div class="col">
                                <label  class="form-label"><b>Hiển thị</b></label>
                                    <select class="form-select input-sm" name="cate_pro_status">
                                        <option selected value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                </select>
                            </div>
                            <div class="col">
                                <br>
                                <label for=""></label>
                                <button class="add btn btn-primary"  type="submit"
                                 name="add-cate-pro">Thêm danh mục</button>
                            </div>
                       </div>
<style>
    .card{
        padding: 20px 300px
    }
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
