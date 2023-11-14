
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('public/fonts/fontawesome-free-6.0.0/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/Frontend/css/main.css')}}">
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="crossorigin="anonymous"></script>
    <!-- Boostrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
        <header class="fixed header position" style="margin-bottom: 100px;">
            <div class="d-flex justify-content-between " style=" margin: 10px 30px 20px 30px;">
                <!-- logo -->
                <a href="{{URL ::to('/')}}">
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
                    <form action="{{URL::to('/search')}}" method="POST" style="margin-top: 20px ; margin-left:-50px;">
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
                <div class="dropdown login" style="color:black;margin-top: 15px;">
                    <a class="btn btn-secondary dropdown-toggle"
                     href="{{URL ::to('/log-out')}}" role="button"
                      id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                      <?php
                        $name = Session::get('customer_name');
                        if ($name)
                        {
                            echo $name;
                        }
                        ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <li><a class="dropdown-item" href="{{URL ::to('/')}}">Tài khoản</a></li>
                      <li><a class="dropdown-item" href="{{URL ::to('/ordered/'.$customer_id)}}">Đơn mua</a></li>
                      <li><a class="dropdown-item" href="{{URL ::to('/log-out')}}">Đăng xuất</a></li>
                    </ul>
                </div>
                <?php
                    } else {
                ?>
                    <div class="dropdown login" style="color:black;margin-top: 15px; ">
                        <a class="btn btn-secondary dropdown-toggle"
                        href="{{URL ::to('/login')}}" role="button" >
                        Đăng nhập
                        </a>
                    </div>
                <?php
                    }
                ?>
                <div class="cart" style="">
                    @php
                        $cart = Session::get('cart');
                    @endphp
                    <a href="{{URL ::to('/show-cart-ajax')}}" style="text-decoration: none; color:black;"><i
                            class="fa-solid fa-cart-shopping"></i>
                        <span id="circle">
                            @if($cart == true)
                            {{ count($cart) }}
                            @elseif($cart == 0)
                            0
                            @endif

                            </span>
                    </a>
                </div>
                </div>

            </div>
            </div>
        </header>
    <div class=" header container-fluid" style="margin-top: 110px; ">
        <div class="row">
            <div class="col-2 container " style="padding: 10px; margin-left:80px; ">
                <div class="user">
                    <span>
                        <a href="{{ URL::to('/customer/'.$customer_id) }}" style="text-decoration:none;">
                            <p style="color: black; ">
                                <i class="fas fa-user"></i>
                                <?php
                                $name = Session::get('customer_name');
                                if ($name) {
                                    echo $name;
                                }
                                ?>
                            </p>
                        </a>
                    </span>
                    <span>
                    </span>
                </div>
                <div class="ordered">
                    <a href="{{ URL::to('/ordered/'.$customer_id) }}" style="text-decoration:none;">
                        <p style="color: black;">
                            <i class="fas fa-shop"></i>
                            Đơn mua
                        </p>
                    </a>
                </div>
                <div class="address">
                    <a href="{{ URL::to('/address/'.$customer_id) }}" style="text-decoration:none;">
                        <p style="color: black;  ">
                            <i class="fa-solid fa-location-dot"></i>
                            Địa chỉ
                        </p>
                    </a>
                </div>
            </div>
            <div class="col-9 container-fluid " style="padding:5px; margin-top: -8px; " >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3"></div>
                <div class="col-8 container" style="">
                    <div>@yield('customer')</div>

                </div>
            </div>

</body>
<footer style="position: " >

    <div class="container ft"  style="">
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
let mybutton = document.getElementById("myBtn");
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"type="text/javascript"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.order').click(function(){
            Swal.fire({
                title: 'Xác nhận đặt hàng',
                showDenyButton: true,
                //showCancelButton: true,
                confirmButtonText: 'Đặt hàng',
                denyButtonText: `Không đặt`,
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                  var customer_id = $('.customer_id').val();
                  var ship_name = $('.ship_name' ).val();
                  var ship_phone = $('.ship_phone').val();
                  var ship_address = $('.ship_address').val();
                  var ship_note = $('.ship_note').val();
                  var _token = $('input[name="_token"]').val();
                  $.ajax({
                      url: '{{url('/confirm-order')}}',
                      method: 'POST',
                      data:{customer_id:customer_id, ship_name:ship_name, ship_phone:ship_phone, ship_address:ship_address, ship_note:ship_note, _token:_token},
                      success:function(data){
                        Swal.fire('Đã đặt hàng, xin cảm ơn!', '', 'success');

                      }
                  });

                } else if (result.isDenied) {
                  Swal.fire('Đặt hàng không thành công!', '', 'info');
                }
                window.setTimeout(function(){
                    location.reload();
                  }, 1000);

              })

        });
    });
</script>
<script type="text/javascript">
    function Cancelorder(id){
        var order_code = id ;
        var reason = $('.reason_cancel').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: '{{url('/cancel-order')}}',
            method: 'POST',
            data:{order_code:order_code, reason:reason, _token:_token},
            success:function(data){
              Swal.fire('Hủy đơn hàng thành công!', '', 'success');
            }
        });
        window.setTimeout(function(){
            location.reload();
          }, 1000);
    };
</script>
