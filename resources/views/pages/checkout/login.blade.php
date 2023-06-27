<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <title>Đăng nhập</title>
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

        <form action="{{URL::to('/login-customer')}}" method="post"  >
            {{ csrf_field() }}
            <div class="wrapper">
                <div class="container">
                  <form class="form">
                    <a href="javascript:window.history.back()">
                        <button type="button" class="btn-close" aria-label="Close"
                        style="float: right; margin-top: -40px"></button>
                    </a>
                    <div class="overlay" style="width: 400px;
                    margin: 11% -4%;">
                           <div class="con" >
                           <header class="head-form"><h2>ĐĂNG NHẬP</h2></header>
                           <?php
                                $message = Session::get('message');
                                if ($message) {
                                    echo $message;
                                    Session::pull('message', null);
                                }
                            ?>
                           <br><br>
                           <div class="field-set">
                                <label for=""><b>Email</b></label>
                                <br>
                                    <input class="form-input" id="txt-input"
                                    type="email" name="email" placeholder="" required><br>
                                <label for=""><b>Mật khẩu</b></label> <br>
                                    <input class="form-input" type="password"
                                    name="password" placeholder="" id="pwd" required>
                                <br>
                                <button type="submit" class="log-in"> <b>ĐĂNG NHẬP</b> </button>
                           </div>
                            <div class="other">
                              <button class="btn submits frgt-pass">Quên mật khẩu?</button>
                             <a href="{{ URL::to('/sign-up') }}">
                                <div class="btn sign-up">Đăng ký
                                     <i class="fa fa-user-plus" aria-hidden="true"></i>
                                </div>
                            </a>
                           </div>
                          </div>
                        </div>
        </form>
    </div>
</body>
<style>
    form {
        width: 450px;
        min-height: 500px;
        height: auto;
        border-radius: 5px;
        margin: 2% auto;
        box-shadow: 0 9px 50px hsla(20, 67%, 75%, 0.31);
        padding: 2%;
        background-image: linear-gradient(-225deg, #E3FDF5 50%, #FFE6FA 50%);
      }
      .head-form{
        text-align: center;
      }
      {{-- .field-set{
        margin-left: 70px;
      } --}}
      label {
        display: inline-block;
        margin-bottom: 10px;
    }
    .form-input{
        margin-bottom: 5px;
        width: 230px;
        border-radius: 3px;
        height: 40px;
    }
    .log-in{
        margin-top: 30px;
       // margin-left: 50px;
        background: rgb(30, 140, 200);
        border-radius: 5px;
        height: 40px;
        color: white;
        border-color:  rgb(30, 140, 200);
    }
    {{-- .other{
        margin-left: 70px
    } --}}
</style>
</html>
