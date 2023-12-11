<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
     <title>Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
     integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css
    " rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
     crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,
    400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="{{asset('public/Backend/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/Backend/css/alert.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
     <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('public/fonts/fontawesome-free-6.0.0/css/all.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css"
     integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{URL::to('/dashboard')}}">
               <!--<div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>-->
                <div class="mx-3 sidebar-brand-text">SHE - FASHION</div>
            </a>

            <!-- Divider -->
            <hr class="my-0 sidebar-divider">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{URL::to('/dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Tổng quan</span></a>
            </li>
            @hasrole(['editor', 'admin'])
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Danh mục
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span><b>Quản lý Danh mục</b> </span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="py-2 rounded collapse-inner bg-light">
                        <h6 class="collapse-header" ></h6>
                        <a class="collapse-item"  href="{{URL::to('/list-category-product')}}">Danh sách danh mục</a>
                        <a class="collapse-item" href="{{URL::to('/add-category-product')}}">Thêm danh mục</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Sản phẩm
            </div>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span><b>Quản lý Sản phẩm</b></span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <h6 class="collapse-header"></h6>
                        <a class="collapse-item" href="{{URL::to('/list-product')}}">Danh sách sản phẩm</a>
                        <a class="collapse-item" href="{{URL::to('/add-product')}}">Thêm sản phẩm</a>
                    </div>
                </div>
            </li>
            @endhasrole
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Người dùng
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fa fa-fw fa-user"></i>
                    <span><b>Quản lý Khách hàng</b></span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item" href="{{URL::to('/manage-customer')}}">Danh sách</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
               Vận chuyển
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagedelivery"
                    aria-expanded="true" aria-controls="collapsePagedelivery">
                    <i class="fa fa-fw fa-user"></i>
                    <span><b>Quản lý Vận chuyển</b></span>
                </a>
                <div id="collapsePagedelivery" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <a class="collapse-item" href="{{URL::to('/manage-delivery')}}">Danh sách</a>
                    </div>
                </div>
            </li>
            @hasrole(['editor', 'admin'])
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Đơn hàng
            </div>
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{URL::to('/manage-order')}}">
                    <i class="fas fa-fw fa-box"></i>
                    <span><b>Quản lý Đơn hàng</b> </span>
                </a>
            </li>
            @endhasrole
            @hasrole(['admin'])
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Quyền truy cập
            </div>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiess"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span><b>Quản lý Quyền truy cập</b></span>
                </a>
                <div id="collapseUtilitiess" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="py-2 bg-white rounded collapse-inner">
                        <h6 class="collapse-header"></h6>
                        <a class="collapse-item" href="{{URL::to('/all-permission')}}">Danh sách </a>
                        <a class="collapse-item" href="{{URL::to('/add-permission')}}">Thêm </a>
                    </div>
                </div>
            </li>
            @endhasrole
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Đánh giá
            </div>
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{URL::to('/manage-review')}}">
                    <i class="fas fa-fw fa-check-to-slot"></i>
                    <span><b>Quản lý Đánh giá</b> </span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Bình luận
            </div>
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{URL::to('/manage-comment')}}">
                    <i class="fas fa-fw fa-comment"></i>
                    <span><b>Quản lý Bình luận</b></span>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="border-0 rounded-circle" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="mb-4 bg-white shadow navbar navbar-expand navbar-light topbar static-top">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="mr-3 btn btn-link d-md-none rounded-circle">
                        <i class="fa fa-bars" style="color: #0acfcf"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form action="{{URL::to('/admin_search')}}" method="POST"
                        class="my-2 mr-auto d-none d-sm-inline-block form-inline ml-md-3 my-md-0 mw-100 navbar-search">
                        {{ csrf_field() }}
                        <div class="input-group">
                            <input type="text"  class="border-0 form-control bg-light small" placeholder="Tìm kiếm"
                                aria-label="Search" aria-describedby="basic-addon2" name="key_word">
                            <div class="input-group-append" >
                                <button class="btn btn-primary"  type="submit" >
                                    <i class="fa fa-search fa-sm" ></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="ml-auto navbar-nav">
                        <!-- Nav Item - Alerts -->
                        <li class="mx-1 nav-item dropdown no-arrow">
                             <a class="nav-link dropdown-toggle" href="" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span style="color:black;"><b>
                                    <?php
                                    $name = Auth::user()->admin_name;
                                   if($name){
                                        echo $name;
                                    }
                                ?>
                                </b>
                                </span>
                            </a>
                             <!-- Dropdown - Alerts -->
                            <div class="shadow dropdown-list dropdown-menu animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <a class="dropdown-item d-flex align-items-center" href="{{URL ::to('/logout-admin')}}">
                                    Đăng xuất
                                </a>
                            </div>

                        </li>


                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('admin_content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="my-auto text-center copyright">
                        <span>Copyright &copy; She 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    <a class="rounded scroll-to-top" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Custom scripts for all pages-->

    <!-- Page level custom scripts -->
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"
    type="text/javascript"></script>
  //  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("#add_category").val({
            rules:{
                cate_pro_name: "required",
            },
            messages:{
                cate_pro_name: "Tên danh mục là bắt buộc",
            },
            submitHandler: function(form) {
                form.submit();
              }

        });
    </script>

    {{-- <script>
        CKEDITOR.replace('ckeditor');
        CKEDITOR.replace('ckeditor1');
    </script> --}}

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
     crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
     integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
      crossorigin="anonymous"></script>
    <!-- owl carousel -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
     integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
     integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
     integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
       crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
      integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
       crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
      integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD"
       crossorigin="anonymous"></script>
      <script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $('.btn_customer_status').click(function(){
            var customer_status = $(this).data('customer_status');
            var customer_id = $(this).data('customer_id');
            //alert(comment_user);
           // alert(comment_id);
           // alert(comment_product_id);
           if(customer_status ==0 ){
                var alert = 'Bỏ chặn thành công';
           }else{
                 var alert = 'Chặn thành công';
           }
           $.ajax({
            method:'POST',
            url: '{{url('/approve-customer')}}',
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{customer_status:customer_status, customer_id:customer_id
                   },
            success:function(data) {
                $('#notify_customer').html('<p>'+alert+'</p>').fadeOut(2000);
                location.reload();
            }
        });

        });
        $('.update_quantity_order').click(function () {
            var order_product_id = $(this).data('product_id');
            var order_qty = $('.order_qty_'+order_product_id).val();
            var order_code = $('.order_code').val();
            var _token = $('input[name="_token"]').val();

            //alert(order_product_id);
            //alert(order_qty);
            //alert(order_code);
            $.ajax({
                type:'POST',
                url:'{{ url('/update-qty-order') }}',
                data:{_token:_token, order_product_id:order_product_id, order_qty:order_qty, order_code:order_code
                       },
                success:function(data) {
                    alert("Cập nhật trạng thái đơn hàng thành công");
                    //location.reload();
                }
            });

        })
    </script>
    <script type="text/javascript">
        $('.order_details').change(function(){
            var order_status = $(this).val();
            var order_code = $(this).children(":selected").attr("id");
            var _token = $('input[name="_token"]').val();

           //alert(order_code);
            //lay so luong
            quantity = [];
            $("input[name='product_sale_quantity']").each(function(){
                quantity.push($(this).val());
            });

            //lay product_id
            order_product_id = [];
            $("input[name='order_check_quantity']").each(function(){
                order_product_id.push($(this).val());
            });

            //dem chuoi
            j = 0;
            for(i=0; i<order_product_id.length; i++){
                //sl trong don hang
                var order_qty = $('.order_qty_'+order_product_id[i] ).val();
                // sl trong kho
                var order_qty_storage = $('.order_qty_storage_'+order_product_id[i] ).val();
                if(parseInt(order_qty) > parseInt(order_qty_storage)){
                    j = j + 1;
                    if(j == 1){
                        alert('Số lượng hàng trong kho không đủ');
                    }
                    $('.error_quantity_'+order_product_id[i]).css('background','rgb(238, 98, 82)');
                }
            }
            if( j==0 ){
                $.ajax({
                    type:'POST',
                    url:'{{ url('/update-quantity-order') }}',
                    data:{_token:_token, order_status:order_status, order_code:order_code,
                         quantity:quantity, order_product_id:order_product_id },
                    success:function(data) {
                         Swal.fire({
                        title: "Cập nhật trạng thái đơn hàng thành công",
                        showCancalButtons: true,
                        confirmButtonClass: "btn btn-danger",
                    });
                    window.setTimeout(function(){
                        location.reload();
                      }, 2000);

                        //location.reload();
                    }
                });
            }
            //alert(j);


        });

    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('send_order').click(function(){
                swal({
                    title: "Xác nhận đơn hàng",
                    text: "Đơn hàng sẽ được đặt, bạn có muốn đặt không?",
                    type: "warning",
                    showCancalButtons: true,
                    confirmButtonClass: "btn btn-danger",
                    confirmButtonText: "Cảm ơn bạn đã mua hàng",
                })
            })
        })
    </script>
    <!-- jquery -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script type="text/javascript">
    $( function() {
        $( "#datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy-mm-dd"
        });
        $( "#datepicker2" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy-mm-dd"
        });


    }
    );

    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
   <script>
    $(document).ready(function(){
        chart30daysorder();
        //$chart = [];
        {{-- var data = [
        { period: '2014', order: 50, sale: 90, profit:30, quantity:10},
        {period: '2015', order: 65,  sale: 75, profit:40, quantity:10}
        { period: '2016', order: 50,  sale: 50, profit:30, quantity:10}] --}}

        chart =  new Morris.Area({
            element: 'area-chart',
           // data: data,
            fillOpacity: 0.6,
            hideHover: 'auto',
            behaveLikeLine: true,
            resize: true,
            pointFillColors:['#ffffff'],
            pointStrokeColors: ['black'],
            lineColors:['gray','red'],
            xkey: 'period',
            ykeys: ['order', 'sale', 'profit', 'quantity'],
            labels: ['Đơn hàng', 'Doanh số', 'Lợi nhuân', 'Số lượng'],
        });
        $('#btn-dashboard-filter').click(function(){
            var _token = $('input[name="_token"]').val();
            var from_date = $('#datepicker').val();
            var to_date = $('#datepicker2').val();
            $.ajax({
                url:'{{ url('/filter-by-date') }}',
                type: 'POST',
                dataType: 'json',
                data:{_token:_token, from_date:from_date, to_date:to_date},
                success: function (data) {
                    chart.setData(data);
                   // console.log(data);
                }
            });
        });
        $('.dashboard-filter').change(function(){
            var dashboard_value = $(this).val();
            var _token = $('input[name="_token"]').val();
           // alert(dashboard_value);
            $.ajax({
                url:"{{ url('/dashboard-filter') }}",
                method:"post",
                dataType: "json",
                data:{dashboard_value:dashboard_value, _token:_token},
                success: function(data){
                    chart.setData(data);
                }
            });
        });
        function chart30daysorder(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{ url('/days-order') }}",
                method:"post",
                dataType: "json",
                data:{ _token:_token},
                success: function(data){
                    chart.setData(data);
                }
            });
        }
    });


</script>
<script type="text/javascript">
    $(document).ready(function(){
        order_review();
        //alert(product_id);
        function order_review(){
            var order_code = $('.order_code').val();
            var customer_id = $('.customer_id').val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: '{{url('/order-review')}}',
                method: 'POST',
                data:{order_code:order_code, customer_id:customer_id, _token:_token},
                success:function(data){
                    $('#order_reviews').html(data);
                }
            });
        }
    });
</script>
<script>
    $(document).ready(function(){
        fetch_delivey();
        $('.choose').on('change', function(){
            var action = $(this).attr('id');
            var ma_tp = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result ='';
            {{-- alert(action);
            alert(matp);
            alert(_token); --}}

            if(action == 'city'){
                result = 'district';
            }else{
                result = 'ward';
            }
            $.ajax({
                url: '{{url('/select-delivery')}}',
                method: 'POST',
                data:{action:action, ma_tp:ma_tp, _token:_token},
                success:function(data){
                    $('#' + result).html(data);
                }
            });

        });
        $('.add_fee_delivery').click(function(){
            var city = $('.city').val();
            var district = $('.district').val();
            var ward = $('.ward').val();
            var feeship = $('.feeship').val();
            var _token = $('input[name="_token"]').val();
            {{-- alert(city);
            alert(district);
            alert(ward);
            alert(feeship); --}}
            $.ajax({
                url: '{{url('/add-delivery')}}',
                method: 'POST',
                data:{city:city, district:district, ward:ward, feeship:feeship, _token:_token},
                success:function(data){
                    alert('Thêm thành công');

                }
            });
            window.setTimeout(function(){
                location.reload();
              }, 2000);
        });
        function fetch_delivey(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/load-delivery')}}',
                method: 'POST',
                data:{ _token:_token},
                success:function(data){
                    $('#load_delivery').html(data);
                }
            });
        }
        $(document).on('blur', '.feeship_edit', function(){
            var feeship_id = $(this).data('feeship_id');
            var fee = $(this).text();
            var _token = $('input[name="_token"]').val();
            {{-- alert(feeship_id);
            alert(fee); --}}
            $.ajax({
                url: '{{url('/update-fee')}}',
                method: 'POST',
                data:{ feeship_id:feeship_id, fee:fee, _token:_token},
                success:function(data){
                    fetch_delivey();
                }
            });


        });
    });
</script>

</body>

</html>
