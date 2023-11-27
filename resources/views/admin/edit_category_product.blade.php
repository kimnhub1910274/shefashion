@extends('admin_dashboard')
@section('admin_content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<div class="row">
    <div class="col-lg-12">
        <?php
            $message = Session::get('message');
            if($message){
                echo $message;
                Session::pull('message', null);
            }
        ?>
        <section class="panel">
            <header class="panel-heading">
                <h3>CẬP NHẬT DANH MỤC SẢN PHẨM</h3>

            </header>
            <div class="panel-body">
                @foreach ($edit_category_product as $key => $edit_value )
                    <div class="position-center">
                        <form action="{{URL::to('/update-category-product/'.$edit_value->cate_id)}}"
                             method="post" enctype='multipart/form-data'>
                            {{ csrf_field() }}
                            <div class="mb-3">
                                <label  class="form-label">Tên danh mục</label>
                                <input type="text" value="{{$edit_value->cate_name}}"
                                 class="form-control" name="cate_pro_name" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label  class="form-label">Từ khóa danh mục</label>
                                <textarea class="form-control" style="resize:none;"
                                 name="meta_key" rows="3">{{$edit_value->meta_keywords}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label  class="form-label">Mô tả</label>
                                <textarea class="form-control" style="resize:none;"
                                 name="meta_desc" rows="3">{{$edit_value->meta_desc}}</textarea>
                            </div>

                            <button class="add btn btn-primary" type="submit" name="update_cate_pro">
                                Cập nhật danh mục</button>
                            <style>
                                .mb-3{
                                    width: 60%;
                                }
                                .panel{
                                    margin-left: 30%;
                                }
                                .add{
                                    margin-bottom: 120px
                                }
                            </style>
                        </form>
                    </div>
                @endforeach
            </div>
        </section>

</div>


@endsection
