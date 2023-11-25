@extends('welcome')
@section('home')
<title>Chi tiết sản phẩm</title>
@foreach ($product_details as $key => $value )
<div class="container product-details" style="margin-top: 50px;"><!--product-details-->
    <form action="">
        {{csrf_field() }}
        <div class="row">
            <div class="col" style="margin-top: 50px;">
                <div class="view-product">
                    <input type="hidden" value="{{$value->product_id}}"
                    class="cart_product_id_{{$value->product_id}}">

                <input type="hidden" value="{{$value->product_name}}"
                    class="cart_product_name_{{$value->product_id}}">

                <input type="hidden" value="{{$value->product_image}}"
                    class="cart_product_image_{{$value->product_id}}">

                <input type="hidden" value="{{$value->product_quantity}}"
                    class="cart_product_quantity_{{$value->product_id}}">

                <input type="hidden" value="{{$value->product_price}}"
                    class="cart_product_price_{{$value->product_id}}">

                    <img src="{{ URL::to('public/uploads/product/'.$value->product_image) }}"
                     alt="" width="300" height="300" style="margin-bottom: 20px"/>
                        <div class="row">
                            @foreach ($related as $key => $relate )
                                <div class="col">
                                    <a href="{{ URL::to('/product-detail/'.$relate->product_id) }}">
                                        <img src="{{ URL::to('public/uploads/product/'.$relate->product_image) }}"
                                         alt="" width="100" height="100" style="margin-left: -30px"/>
                                </a>
                                </div>
                            @endforeach
                        </div>
                </div>
            </div>
            <div class="col">
                <div class="product-information"><!--/product-information-->
                    <h2>{{$value->product_name}}</h2>
                    <span>
                        <p><b>Mô tả:</b> {{$value->product_desc}}</p>
                        <p><b>Danh mục:</b> {{$value->cate_name}}</p>
                        <p><b>Tình trạng:</b> Còn {{$value->product_quantity}} sản phẩm</p>
                            <p> <b>Giá:</b> {{number_format($value->product_price)}} VND</p>
                            <div class="row">
                                <div class="col">
                                    <label><b>Số lượng:</b></label>
                                    <input type="number" class="cart_product_qty_{{$value->product_id}}"
                                     value="1" name="quantity" style="width:50px ;" min="1" />
                                    <input type="hidden" value="{{$value->product_id}}"
                                    name="product_id_hidden" style="width:50px;" />

                                </div>
                                <div class="col">
                                    <label for=""><b>Kích cỡ:</b></label>
                                    <select class="form-select cart_size cart_product_size_{{$value->product_id}}" name="size" >
                                        <option selected value="0" id="{{$value->product_id}}">Chọn</option>
                                        <option value="1">S</option>
                                        <option value="2">M</option>
                                        <option value="3">L</option>
                                        <option value="4">XL</option>

                                      </select>
                                </div>
                                <div class="col">
                                    <label for=""><b>Màu sắc:</b></label>
                                    <select class="form-select cart_color cart_product_color_{{$value->product_id}}" name="color" >
                                        <option selected value="0" id="{{$value->product_id}}">Chọn</option>
                                        <option value="1">Vàng</option>
                                        <option value="2">Trắng</option>
                                        <option value="3">Hồng</option>
                                        <option value="4">Xanh</option>

                                      </select>
                                </div>
                            </div>
                            <br>
                            <br>
                            <button type="button" class="add-to-cart marker:btn btn  cart"
                            style="background-color: rgb(143, 10, 10); color:white;"
                            data-id_pro="{{$value->product_id}}" name="add-to-cart">
                                <i class="fa fa-shopping-cart"></i>
                                Thêm vào giỏ hàng
                            </button>
                    </span>
                </div><!--/product-information-->
            </div>
        </div>
    </form>
    <div class="product-detail-tab">
        <div class="col-sm-12">
            <ul class="nav ">
                <li><b>BÌNH LUẬN</b></li>
            </ul>
            <br>
            <form action="" method="post">
                @csrf
                <input type="hidden" class="comment_product_id"
                 name="comment_product_id" id="" value="{{$value->product_id}}">
                <div id="comment"></div>
            </form>
            <br>
            <ul class="nav ">
                <b>VIẾT BÌNH LUẬN</b></li>
            </ul>
            <br>
            <form action="" >
                @csrf
                <div class="row g-3 align-items-center" >
                    <div class="col-auto">
                      <input type="text" name="comment_user"
                       class="form-control comment_user" placeholder="Tên của bạn">
                    </div>
                    <div>
                        <textarea class="form-control comment_content" name="comment" id=""
                         cols="30" rows="3" placeholder="Viết bình luận"></textarea>
                    </div>
                    <div>Đánh giá:</div>
                    <div id="notify_comment"></div>

                </div>
                <button type="button" class="send-comment btn" style="background-color: rgb(143, 10, 10); color:white;">Gửi</button>
            </form>

        </div>
    </div>
        <style>
        .product-details {
          margin-bottom: 40px;
          overflow: hidden;
          margin-top: 10px;
        }
        .circle {
            clip-path: circle(20%);
            height: 30px;
            width: 5em;
            margin: 0px
          }

    </style>
</div><!--/product-details-->
@endforeach

@endsection
