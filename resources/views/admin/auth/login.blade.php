
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Admin - Đăng nhập</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
         crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
         integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
          crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
         integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
          crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
         integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD"
          crossorigin="anonymous"></script>

        <!-- Fontawesome -->
        <link rel="stylesheet" href="{{{'public/fonts/fontawesome-free-6.0.0/css/all.min.css'}}}">
        <!-- CSS -->
        <link rel="stylesheet" href="{{{'public/Backend/css/login.css'}}}">
        {{-- <link rel="stylesheet" href="{{{'public/js/.js'}}}"> --}}
    </head>

<body>
    <div class="login">

        <form action="{{URL::to('/login')}}" method="post"  >
            {{ csrf_field() }}
            <div class="wrapper">
                <div class="container">
                  <form class="form">
                    <div class="overlay">
                           <div class="con">
                           <header class="head-form"><h2>ĐĂNG NHẬP AUTH</h2>  </header>
                           <br>
                           <?php
                                $message = Session::get('message');
                                if ($message){
                                    echo $message;
                                    Session::pull('message', null);
                                }
                            ?>
                           <br><br>
                           <div class="field-set" style="margin-left: 0PX;">
                                 <input class="form-input" id="txt-input" type="text"
                                 name="admin_email" placeholder="Email" required>
                              <br>
                              <input class="form-input" type="password"
                               name="admin_password" placeholder="Mật khẩu" id="pwd"  name="password" required>
                              <br>
                           </div>
                           <button class="log-in" style="margin-left: 70px"> ĐĂNG NHẬP </button>
                           <br>
                            <div class="other">
                        <!--     Sign Up button -->
                              <a href="{{URL::to('/register-admin')}}" class="btn submits sign-up"
                               style="width: 100px">Đăng ký Auth
                        <!--         Sign Up font icon -->
                              </a>
                           </div>
                          </div>
                        </div>
        </form>
    </div>
</body>

</html>
