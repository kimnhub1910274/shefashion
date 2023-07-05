
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- <meta name="description" content="{{$meta_desc}}">
    <meta name="keywords" content="{{$meta_keywords}}">
    <meta name="robots" content="">
    <meta name="author" content="">
    <link rel="canonical" href="{{$meta_url}}"> --}}
    <link rel="icon" type="image/x-icon" href="">

    {{-- <meta property="og:image" content="{{$meta_image}}"/>
    <meta property="og:site_name" content="http://localhost/shefashion"/>
    <meta property="og:description" content="{{$meta_desc}}"/>
    <meta property="og:title" content="{{$meta_title}}"/>
    <meta property="og:url" content="{{$meta_url}}"/>
    <meta property="og:type" content="website"/> --}}


    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
     rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('public/fonts/fontawesome-free-6.0.0/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/Frontend/css/main.css')}}">
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
     integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
     crossorigin="anonymous"></script>
    <!-- Boostrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
     integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
     crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
     integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
     crossorigin="anonymous"></script>
    <!-- owl carousel -->
    <script src="owlcarousel/owl.carousel.min.js"></script>
</head>

<body>

    <header class="fixed header" style="margin-bottom: 100px;">
        <div class="container-fluid d-flex justify-content-between" style=" margin: 10px 30px 20px 3px;">
            <!-- logo -->
            <a href="{{URL ::to('/home')}}">
                <img class="she" src="{{asset('public/images/She.png')}}" alt="">
            </a>
            <style>
                .she{
                    width: 250px;
                    border-radius: 20px;
                }
            </style>
            <ul class="p-1 nav d-sm-none d-md-none d-lg-flex d-xl-flex">
                <li class="nav-item align-self-center ">
                    <a class=" menu nav-link align-self-center d-none d-sm-none d-md-none d-lg-flex d-xl-flex"
                        style="font-weight: 400;color:black;" href="{{URL ::to('/home')}}" aria-current="page">
                        <b>TRANG CHỦ</b></a>
                </li>
                <li class="nav-item align-self-center">
                    <a class=" menu nav-link align-self-center d-none d-sm-none d-md-none d-lg-flex d-xl-flex"
                        style="font-weight: 400;color:black;" href="{{URL ::to('/introduce')}}">
                        <b>GIỚI THIỆU</b></a>
                </li>
                <li class="nav-item align-self-center">
                    <a class=" menu nav-link align-self-center d-none d-sm-none d-md-none d-lg-flex d-xl-flex"
                        style="font-weight: 400;color:black;" href="{{URL ::to('/product')}}">
                        <b>SẢN PHẨM</b></a>
                </li>
                <li class="nav-item align-self-center">
                    <a class="menu nav-link align-self-center d-none d-sm-none d-md-none d-lg-flex d-xl-flex"
                        style="font-weight: 400;color:black;" href="{{URL ::to('/news')}}">
                        <b>TIN TỨC</b> </a>
                </li>
            </ul>
            <!-- offcanvas menu-->
            <div class="d-flex">
                <div class="align-self-center me-3">
                    <nav class="navbar navbar-expand-xl navbar-expand-lg navbar-light" aria-labelledby="">
                        <!-- nút menu -->
                        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                            <span class="navbar-toggler-icon"></span></button>
                        <!-- offcanvas -->
                        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
                            aria-labelledby="offcanvasExampleLabel">
                            <div class="offcanvas-header">
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <div class="login">
                                <?php
                                    $customer_id = Session::get('customer_id');
                                    if ($customer_id != null) {
                                ?>
                                    <div class="login" style="color:black;margin-top: 20px;">
                                        <a href="{{URL ::to('/log-out')}}"><b>Đăng xuất,</b></a>
                                    </div>
                                <?php
                                    } else {
                                ?>
                                    <div class="login" style="color:black;margin-top: 20px;">
                                        <a href="{{URL ::to('/login')}}"><b>Đăng nhập</b></a>
                                    </div>
                                <?php
                                    }
                                ?>
                                <div style="color: black; margin: 10px 10px 20px ">
                                    <?php
                                    $name = Session::get('customer_name');
                                    if ($name) {
                                        echo $name;
                                    }

                                    ?>
                                </div>
                            </div>
                            <div class="mx-2 d-flex justify-content-end">

                            </div>
                            <hr>
                            <div class="p-0 mx-3 offcanvas-body">
                                <div class="mt-3 dropdown">
                                    <ul class="navbar-nav">
                                        <li class="pt-3 nav-item px-xl-5 px-lg-4 px-md-3">
                                            <a href="{{URL ::to('/home')}}"
                                            style="text-decoration:none;color:black;"><b>TRANG CHỦ</b></a>
                                        </li>
                                        <li class="pt-3 nav-item px-xl-5 px-lg-4 px-md-3">
                                            <a href="{{{ 'pages/introduce.php' }}}"
                                            style="text-decoration:none;color:black;"><b>GIỚI THIỆU</b></a>
                                        </li>
                                        <li class="pt-3 nav-item px-xl-5 px-lg-4 px-md-3">
                                            <a href="{{{'pages/product.php'}}}"
                                             style="text-decoration:none;color:black;"><b>SẢN PHẨM</b></a>
                                        </li>
                                        <li class="pt-3 nav-item px-xl-5 px-lg-4 px-md-3">
                                            <a href="{{URL ::to('/news')}}"
                                             style="text-decoration:none;color:black;"><b>TIN TỨC</b></a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
                <!--search-->
                <form action="{{URL::to('/search')}}" method="POST" style="margin-top: 20px ;">
                    {{csrf_field()}}
                    <div class="dropdown align-self-center d-sm-none d-md-none d-none d-lg-flex d-xl-flex">
                        <div class="dropdown-content">
                            <div>
                                <input class="input-search" name="key_word" type="text" placeholder="Tìm kiếm">
                            </div>
                        </div>
                        <div>
                            <button type="submit"  name="search" style="border:white ;">
                                <i class="search fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                        {{-- <div class="dropdown-content">
                            <input class="input-search" name="key_word" type="text" placeholder="Tìm kiếm">
                            <button type="submit"  name="search" style="border:white ;">
                                <i class="search fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div> --}}
                    </div>
                </form>
            </div>
            <?php
                $customer_id = Session::get('customer_id');
                if ($customer_id != null) {
            ?>
                <div class="login" style="color:black;margin-top: 20px;">
                    <a href="{{URL ::to('/log-out')}}"><b>Đăng xuất, </b></a>
                </div>
            <?php
                } else {
            ?>
                <div class="login" style="color:black;margin-top: 20px;">
                    <a href="{{URL ::to('/login')}}"><b>Đăng nhập</b></a>
                </div>
            <?php
                }
            ?>
            <div style="color: black; margin: 20px 10px 20px ">
                <?php
                $name = Session::get('customer_name');
                if ($name)
                {
                    echo $name;
                }
                ?>
            </div>
            <div class="cart">
                <a href="{{URL ::to('/add-cart-ajax')}}" style="text-decoration: none; color:black;"><i
                        class="fa-solid fa-cart-shopping"></i>
                    <span id="circle">{{ number_format(Cart::getContent()->count()) }}</span>
                </a>
            </div>
        </div>
        </div>
    </header>
    <main>
        <div class="container-fluid " style="margin-top:100px;" >
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                    <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('public/images/bannerhome.png') }}" class="d-block w-100" alt="...">
                </div>
                    <div class="carousel-item">
                        <img src="{{ asset('public/images/bannerhome2.png') }}" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button"
                data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button"
                 data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
          </div>

        </div>

        <div class="container bg-light">
            <div class="row">
                <div class="col-sm-3">
                    <nav class="navbar " aria-level="" aria-labelledby="">
                        <div class="container">
                            <ul class="navbar-nav">
                                <h6><b>DANH MỤC SẢN PHẨM</b></h6>

                                @foreach ($category as $key => $cate)
                                    <li class="nav-item">
                                        <a class="nav-link" style="color:black"
                                        href="{{ URL::to('/category-products/'.$cate->cate_id) }}">
                                        {{ $cate->cate_name }}</a>
                                    </li>

                                @endforeach
                            </ul>
                        </div>
                    </nav>
                    {{-- <div class="fb-like" data-href="{{$meta_url}}"
                     data-width="" data-layout="button_count" data-action="like"
                      data-size="large" data-share="false"></div>
                    <div class="fb-share-button" data-href="http://localhost/shefashion"
                        data-layout="button_count" data-size="large"><a target="_blank"
                        href="https://www.facebook.com/sharer/sharer.php?u={{$meta_url}}&amp;src=sdkpreparse"
                        class="fb-xfbml-parse-ignore">Chia sẻ</a>
                    </div> --}}
                </div>
                <div class="col-9">
                    @yield('home')
                </div>
            </div>
        </div>
    </main>
</body>
<footer class="" style="margin-top:30px;" >

    <div class="container ft">
        <div class="row align-items-start">
            <div class="col">
              <b>DANH MỤC</b>
              <div class="contact">
                  <div><a href="{{URL ::to('/home')}}"
                    style="text-decoration:none ;color:black;">TRANG CHỦ</a></div>
                    <div><a href="{{URL ::to('/introduce')}}"
                         style="text-decoration:none ;color:black;">GIỚI THIỆU</a></div>
                  <div><a href="{{URL ::to('/product')}}"
                     style="text-decoration:none ;color:black;">SẢN PHẨM</a></div>
                  <div><a href="{{URL ::to('/news')}}"
                     style="text-decoration:none ;color:black;">TIN TỨC</a></div>

              </div>
            </div>
            <div class="col">
              <b>ĐỊA CHỈ</b>
              <div class="contact">
                <div class="col">
                    <b>Địa chỉ: 3/2 - Ninh Kiều - Cần Thơ</b>
                  </div>
                  <div class="col">
                    <b>Số điên thoại: 0246.662.3434</b>
                  </div>
                  <p>Copyright She. All rights reserved. </p>
              </div>
            </div>
            <div class="col">
              <b>LIÊN HỆ CHÚNG TÔI</b>
                <div class="contact">
                    <div class="col">
                        CHÍNH SÁCH
                      </div>
                      <div class="col">
                        LIÊN HỆ
                      </div>
                      <div class="icon">
                        <i class="fa-brands fa-facebook"></i>
                        <i class="fa-brands fa-instagram"></i>
                        <i class="fa-brands fa-youtube"></i>
                      </div>
                </div>
            </div>
      </div>
    </div>
    <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>

</footer>
<script>
// Get the button
let mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>

</html>

<script>
/* Demo purposes only */
$("figure").mouseleave(
    function() {
        $(this).removeClass("hover");
    }
);
</script>
<scrip type="text/javascript">
</scrip>
<div id="fb-root"></div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"type="text/javascript"></script>
<script async defer crossorigin="anonymous"
src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v17.0"nonce="bkDS7fsa"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.add-to-cart').click(function(){
            var id = $(this).data('id_pro');
            var cart_product_id = $('.cart_product_id_' + id).val();
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_price = $('.cart_product_price_' + id).val();
            var cart_product_qty = $('.cart_product_qty_' + id).val();
            var _token = $('input[name="_token"]').val();
            //alert(cart_product_name);
            $.ajax({
                url: '{{url('/add-cart-ajax')}}',
                method: 'POST',
                data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token},
                success:function(data){
                    //alert(data);
                }

            });
        });
    });
</script>

