
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <title>Đăng ký</title>
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
        <link rel="stylesheet" href=
        "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
            <!-- jQuery library -->
            <script src=
        "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
            </script>
            <script src=
            "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js">
                </script>
        <!-- Fontawesome -->
        <link rel="stylesheet" href="{{{'public/fonts/fontawesome-free-6.0.0/css/all.min.css'}}}">
        <!-- CSS -->
        <link rel="stylesheet" href="{{{'public/Backend/css/login.css'}}}">
        {{-- <link rel="stylesheet" href="{{{'public/js/.js'}}}"> --}}
    </head>

<body>
    <div class="login">

        <form action="{{URL::to('/add-customer')}}" method="post"  >
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
                            <header class="head-form"><h2>ĐĂNG KÝ</h2>  </header>
                            <?php
                                    $message = Session::get('message');
                                    if($message){
                                        echo $message;
                                        Session::pull('message', null);
                                    }
                                ?>
                            <br><br>
                            <div class="field-set">
                                    <label for=""><b>Họ và tên</b></label><br>
                                        <input class="form-input" id="txt-input"
                                        type="text" name="customer_name" id="usernames" placeholder="" required><br>
                                        <h5 id="usercheck"
                                            style="color: red;">
                                            **Hãy nhập tên người dùng
                                        </h5>

                                    <label for=""><b>Email</b></label><br>
                                        <input class="form-input" id="email"
                                        type="text" name="customer_email" placeholder="" required><br>
                                        <small id="emailvalid"
                                            class="form-text text-muted invalid-feedback">
                                            Hãy nhập email của bạn
                                        </small>

                                    <label for=""><b>Số điện thoại</b></label><br>
                                        <input class="form-input" id="phone"
                                        type="text" name="customer_phone" placeholder="" required><br>

                                    <label for=""><b>Địa chỉ</b></label><br>
                                        <input class="form-input" id="address"
                                        type="text" name="customer_address" placeholder="" required><br>

                                    <label for=""><b>Mật khẩu</b></label> <br>
                                        <input class="form-input" type="password"
                                        name="customer_password" placeholder="" id="pwd"  name="password" required><br>
                                        <h5 id="passcheck"
                                            style="color: red;">
                                            **Hãy nhập mật khẩu
                                        </h5>

                                    <button type="submit" id="sub" class="log-in"> <b>ĐĂNG KÝ</b> </button>
                        </div>
                </div>
                <div class="other">
                    <a href="{{ URL::to('/login-checkout') }}">
                    <div class="btn sign-up">Đăng nhập
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </div>
                    </a>
                </div>
            </div>
        </form>
    </div>
</body>
<script>
    $(document).ready(function(){
        $("#usercheck").hide();
        let usernameError = true;
        $("#usernames").keyup(function(){
            validateUsername();
        });
        function validateUsername(){
            let usernameValue = $("#usernames").val();
            if (usernameValue.length == "") {
                $("#usercheck").show();
                usernameError = false;
                return false;
            }else if (usernameValue.length < 5 || usernameValue.length > 10) {
                $("#usercheck").show();
                $("#usercheck").html("**length of username must be between 3 and 10");
                usernameError = false;
                return false;
            } else {
                $("#usercheck").hide();
            }
        }
         // Validate Email
        const email = document.getElementById("email");
        email.addEventListener("blur", () => {

            let s = email.value;
            if (regex.test(s)) {
                email.classList.remove("is-invalid");
                emailError = true;
            } else {
                email.classList.add("is-invalid");
                emailError = false;
            }
        });
         // Validate Password
        $("#passcheck").hide();
        let passwordError = true;
        $("#password").keyup(function () {
            validatePassword();
        });
        function validatePassword() {
            let passwordValue = $("#password").val();
            if (passwordValue.length == "") {
                $("#passcheck").show();
                passwordError = false;
                return false;
            }
            if (passwordValue.length < 3 || passwordValue.length > 10) {
                $("#passcheck").show();
                $("#passcheck").html(
                    "**length of your password must be between 3 and 10"
                );
                $("#passcheck").css("color", "red");
                passwordError = false;
                return false;
            } else {
                $("#passcheck").hide();
            }
        }
        // Submit button
        $("#sub").click(function () {
            validateUsername();
            validatePassword();
            validateConfirmPassword();
            validateEmail();
            if (
                usernameError == true &&
                passwordError == true &&
                confirmPasswordError == true &&
                emailError == true
            ) {
                return true;
            } else {
                return false;
            }
        });
    });
</script>
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
    .other{
        margin-left: 120px
    }
</style>
</html>
