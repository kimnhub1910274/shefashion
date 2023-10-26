@extends('welcome')
@section('home')
<title>Chi tiết sản phẩm</title>
@foreach ($product_details as $key => $value )
<div class="container product-details"><!--product-details-->
    <div class="row">
        <div class="col-sm-6" style="margin-top: 30px;">
            <div class="view-product">
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
        <div class="col-sm-6">
            <div class="product-information"><!--/product-information-->


                <h2>{{$value->product_name}}</h2>
                <span>
                    <p><b>Mô tả:</b> {{$value->product_desc}}</p>
                    <p><b>Danh mục:</b> {{$value->cate_name}}</p>
                    <p><b>Tình trạng:</b> Còn {{$value->product_quantity}} sản phẩm</p>
                    <form action="{{ URL::to('/save-cartt') }}" method="post">
                        {{csrf_field() }}
                        <p> <b>Giá:</b> {{number_format($value->product_price)}} VND</p>
                        <label><b>Số lượng:</b></label>
                        <input type="number" value="1" name="quantity" style="width:50px ;" min="1" />
                        <input type="hidden" value="{{$value->product_id}}"
                        name="product_id_hidden" style="width:50px;" />

                        <br>
                        <br>
                        <button type="submit" class="btn btn-primary cart">
                            <i class="fa fa-shopping-cart"></i>
                            Thêm vào giỏ hàng
                        </button>
                    </form>
                </span>

            </div><!--/product-information-->
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
