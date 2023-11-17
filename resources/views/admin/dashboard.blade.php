@extends('admin_dashboard')
@section('admin_content')

<style type="text/css">
    p.title{
        text-align: center;
        font-size: 20px;
        font-weight: bold;
    }
</style>
<div class="">
    <div class="row">
        <p class="title">THỐNG KÊ ĐƠN HÀNG DOANH SỐ</p>
        <form action="" autocomplete="off">
            @csrf
           <div class="row">
                <div class="col-md-2">
                    <p>Từ ngày: <input type="text" id="datepicker"
                         class="datepicker form-control" ></p>
                    <input type="button" name="" id="btn-dasboard-filter" class="btn btn-outline-primary" value="Tìm">
                </div>
                <div class="col-md-2">
                    <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
                </div>
                {{-- <div class="col-md-2">
                    <p>Lọc theo:
                        <select name="" id="" class="dashboard-filter form-control">
                            <option value="">Chọn</option>
                            <option value="7days">7 ngày qua</option>
                            <option value="lastmonth">Tháng trước</option>
                            <option value="thismonth">Tháng hiện tại</option>
                            <option value="thisyear">1 năm qua</option>
                        </select>
                    </p>
                </div> --}}

           </div>
        </form>
        <div class="col-md-12">
            <div id="myfirstchart" style="height: 250px"></div>
        </div>
    </div>
    <div class="row">
        <div class="col"></div>
        <div class="col"></div>

    </div>
    <div class="row">
    </div>

</div>
@endsection
