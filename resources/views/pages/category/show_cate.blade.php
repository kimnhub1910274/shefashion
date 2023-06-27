@extends('welcome')
@section('home')

<title>Sản phẩm theo danh mục</title>
  <div class="container text-center">
    @foreach ($cate_name as $key => $name)
        <h4 class="text-center title">{{ $name->cate_name }}</h4>
    @endforeach
    <div class="row">
        @foreach ($cate_by_id as $key => $product )
        <div class="col">
            <a href="{{ URL::to('/product-detail/'.$product->product_id) }}" >
                <img src="{{ URL::to('public/uploads/product/'.$product->product_image) }}"
                 width="200" height="200" style="margin-bottom: 5px" alt="">
                <p>{{ $product->product_name }}</p>
                <span class="price"><b>Giá: {{ number_format($product->product_price).' '.'VND' }}</b></span>
                <span><i class="fa-solid fa-cart-plus"></i></span>
            </a>
        </div>
    @endforeach
    </div>
  </div>
  <div>
    <div class="fb-comments" data-href="{{$meta_url}}" data-width="" data-numposts="20"></div>
  </div>
  <style>
    .fa-cart-plus{
        color: rgb(15, 162, 170);
        margin-bottom: 20px;

      }
      .price{
        color: #af2b1f;
      }
      a{
        text-decoration-line: none;
        color: #000;

      }
</style>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v17.0" nonce="GyInKf0Z"></script>
@endsection

