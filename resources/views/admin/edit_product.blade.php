@extends('admin_dashboard')
@section('admin_content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<div class="card container-sm" style="width:50%">
    <div class="">
        <?php
            $message = Session::get('message');
            if($message){
                echo $message;
                Session::pull('message', null);
            }
        ?>
        <section class="">
            <header class="card-header"  style="text-align: center">
                <h3>CẬP NHẬT SẢN PHẨM</h3>

            </header>
            <div class="card-body">
                <div class="position-center">
                    @foreach ($edit_product as $key => $product)
                        <form action="{{URL::to('/update-product/'.$product->product_id)}}"
                            method="post" enctype='multipart/form-data'>
                            {{ csrf_field() }}
                            <div class="mb-3">
                                <label  class="form-label"><b>Tên sản phẩm</b></label>
                                <input type="text" value="{{ $product->product_name }}"
                                 class="form-control" name="product_name" placeholder="">
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <label  class="form-label"><b>Hình ảnh sản phẩm</b></label>
                                    <input type="file"  class="form-control" name="product_image" placeholder="">
                                </div>
                                <div class="col">
                                    <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}"
                                 height="100" width="100" alt="">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label  class="form-label"><b>Mô tả</b></label>
                                <textarea class="form-control"
                                 name="product_desc" rows="3">{{$product->product_desc}}</textarea>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <label  class="form-label"><b>Giá sản phẩm</b></label>
                                    <input type="text" value="{{ $product->product_price }}"
                                    class="form-control" name="product_price" placeholder="">
                                </div>
                                <div class="col">
                                    <label  class="form-label"><b>Số lượng</b></label>
                                    <input class="form-control"  type="number" min="1"
                                     name="product_quantity" value="{{$product->product_quantity}}"></input>
                                </div>
                                <div class="col">
                                    <label  class="form-label"><b>Số lượng đã bán</b></label>
                                    <input class="form-control"
                                     name="product_sold" value="{{$product->product_sold}}"></input>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <label  class="form-label"><b>Danh mục sản phẩm</b></label>
                                    <select class="form-select input-sm" name="product_cate">
                                        @foreach ($cate_product as $key => $cate)
                                            @if($cate->cate_id == $product->product_id)
                                                <option selected value="{{ $cate->cate_id }}">
                                                    {{ $cate->cate_name }}</option>
                                            @else
                                                <option  value="{{ $cate->cate_id }}">{{ $cate->cate_name }}</option>

                                            @endif
                                        @endforeach
                                </select>
                                </div>
                                <div class="col">
                                    <label  class="form-label"><b>Hiển thị</b></label>
                                    <select class="form-select input-sm" name="product_status">
                                        <option selected value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>
                            </div>
                            <button class="add btn btn-primary"
                                type="submit" name="edit-pro">
                                Sửa sản phẩm
                            </button>
                        </form>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</div>


@endsection
