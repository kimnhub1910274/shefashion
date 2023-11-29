@extends('admin_dashboard')
@section('admin_content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
 rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
  crossorigin="anonymous">
<div class="card container-sm" style="width:50%">
    &nbsp;
    <div class="">
        <?php
            $message = Session::get('message');
            if($message){
                echo $message;
                Session::pull('message', null);
            }
        ?>
        <section class="panel">
            <header class="text-center panel-heading">
                <h3>THÊM PHÍ VẬN CHUYỂN</h3>

            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form action="" method="post" name="delivery">
                        @csrf
                        <div class="mb-3">
                            <label  class="form-label"><b>Chọn tỉnh/thành phố</b></label>
                            <select class="form-select input-sm choose city" name="city" id="city">
                                <option value="0">Chọn tỉnh/thành phố</option>
                                @foreach ($city as $k => $c )
                                <option value="{{ $c->matp }}">{{ $c->city_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label  class="form-label"><b>Chọn quận/huyện</b></label>
                            <select class="form-select input-sm choose district"  name="district" id="district">
                                <option value="0">Chọn quận/huyện</option>

                            </select>
                        </div>
                        <div class="mb-3">
                            <label  class="form-label"><b>Chọn xã/phường</b></label>
                            <select class="form-select input-sm ward" name="ward" id="ward">
                            <option value="0">Chọn xã/phường</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label  class="form-label "><b>Phí vận chuyển</b></label>
                            <input type="text" class="form-control feeship"
                             name="fee_ship" placeholder="" id="">
                        </div>
                        <button type="button" class="btn btn-success add_fee_delivery"
                         name="add_fee_delivery">Thêm phí vận chuyển</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
<br>
<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        <div id="load_delivery"></div>
    </div>
</div>
<style>
    .cardd{
        padding: 20px 300px
    }
    button.add.btn.btn-primary {
        margin-top: 8px;
    }

</style>

@endsection
