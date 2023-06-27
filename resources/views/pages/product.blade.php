@extends('welcome')
@section('home')
<title>Sản phẩm</title>
<div class="container text-center">
    <h4 class="text-center title" style="margin-bottom: 20px"><b>SẢN PHẨM</b> </h4>
    <div class="row">
        @foreach ($list_product as $key => $product )
        <div class="col">
            <form action="{{ URL::to('/save-cart') }}" method="post" >
                {{csrf_field() }}
                <a href="{{ URL::to('/product-detail/'.$product->product_id) }}" >
                    <img src="{{ URL::to('public/uploads/product/'.$product->product_image) }}"
                     width="200" height="200" style="margin-bottom: 5px" alt="">
                    <p>{{ $product->product_name }}</p>
                    {{-- <span><i class="fa-regular fa-heart"></i></span> --}}
                    <input type="hidden" value="{{$product->product_id}}" name="product_id_hidden" />

                    <span class="price"><b>Giá: {{ number_format($product->product_price).' '.'VND' }}</b></span>
                </a>
                    <span>&nbsp;
                        <button type="submit" style="border:none "><i class="fa-solid fa-cart-plus"></i></button>
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
