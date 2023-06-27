@extends('test')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tin tức</title>
</head>
<body>
    <main>
        <div class="banner">
            <img style="width: 100%;    margin-top: -20px;" src="admin/images/tintuc.png" alt="">
        </div>
        <div class="container">
            <h3 style="text-align: center;"><b>SHE ON INSTAGRAM</b></h3>
            <div class="row" style="margin: 20px 0px 20px 100px ;">
                <div class="col-4 new">
                    <img src="{{{'public/images/tintuc3.png'}}}" alt=""
                    style="width:300px; height:300px; background-color: whitesmoke;">
                </div>
                <div class="col-4">
                    <img src="{{{'public/images/tintuc4.png'}}}" alt=""
                    style="width:300px; height:300px; background-color: whitesmoke;">
                </div>
                <div class="col-4">
                    <img src="{{{'public/images/tintuc5.png'}}}" alt=""
                    style="width:300px; height:300px; background-color: whitesmoke;">
                </div>
            </div>
        </div>
    </main>
</body>
</html>
