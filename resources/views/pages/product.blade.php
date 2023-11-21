@extends('welcome')
@section('home')
<title>Sản phẩm</title>
<div class="container-fluid text-center">
    <div class="row">
        <h4 class="text-center title col-8" style="margin-bottom: 20px; margin-top: 30px"><b>SẢN PHẨM MỚI</b></h4>
        <div class="col-md-4">
            <h6 class="text-center title col" style="margin-bottom: 10px; margin-top: 20px">Sắp xếp theo</h6>
            <form action="">
                @csrf
                <select name="sort" id="sort" >
                    <option  value="{{ Request::url() }}?sort_by=none">Lọc</option>
                    <option value="{{ Request::url() }}?sort_by=increase">Giá tăng dần</option>
                    <option value="{{ Request::url() }}?sort_by=reduce">Giá giảm dần</option>
                    <option value="{{ Request::url() }}?sort_by=a_z">A đến Z</option>
                    <option value="{{ Request::url() }}?sort_by=z_a">Z đến A</option>

                </select>
            </form>
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        @foreach ($list_product as $key => $product )
        <div class="col">
            <form >
                {{csrf_field() }}
                <input type="hidden" value="{{$product->product_id}}"
                    class="cart_product_id_{{$product->product_id}}">

                <input type="hidden" value="{{$product->product_name}}"
                    class="cart_product_name_{{$product->product_id}}">

                <input type="hidden" value="{{$product->product_image}}"
                    class="cart_product_image_{{$product->product_id}}">

                <input type="hidden" value="{{$product->product_price}}"
                    class="cart_product_price_{{$product->product_id}}">
                <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">

                <a href="{{ URL::to('/product-detail/'.$product->product_id) }}" >
                    <img src="{{ URL::to('public/uploads/product/'.$product->product_image) }}"
                    width="200" height="200" style="margin-bottom: 5px" alt="">
                    <p>{{ $product->product_name }}</p>
                    {{-- <span><i class="fa-regular fa-heart"></i></span> --}}
                    <input type="hidden" value="{{$product->product_id}}" name="product_id_hidden" />
                    <span class="price"><b>Giá: {{ number_format($product->product_price).' '.'VND' }}</b></span>
                </a>
                    <span>&nbsp;
                        {{-- <button type="submit" style="border:none ">
                            <i class="fa-solid fa-cart-plus" ></i></button> --}}
                        <button type="button" class="add-to-cart" style="border:none" name="add-to-cart"
                         data-id_pro="{{$product->product_id}}" >
                            <i class="fa-solid fa-cart-plus" ></i>

                        </button>
                        </span>
            </form>
        </div>
        @endforeach
    </div>
  </div>

  <style>
    .fa-cart-plus{
        color: rgb(15, 162, 170);
        padding: 5px;

      }
      .price{
        color: #af2b1f;
      }
      a{
        text-decoration-line: none;
        color: #000;

      }
      .col{
        margin-bottom:20px;
</style>

@endsection
