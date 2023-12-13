@extends('admin_dashboard')
@section('admin_content')

<div class="container-fluid card">
    &nbsp;
    <h3>DANH SÁCH SẢN PHẨM </h3>
    <p>Tổng sản phẩm: {{ $product_count }}</p>
    <?php
    $message = Session::get('message');
    if ($message) {
        echo $message;
        Session::pull('message', null);
    }
?>
    <table class="table">
        <thead>
          <tr style="background-color: rgb(235, 185, 235)">
            <th scope="col">STT</th>
            <th scope="col">Tên sản phẩm</th>
            <th scope="col">Hình ảnh</th>
            <th scope="col">Giá </th>
            <th scope="col">Mô tả </th>
            <th scope="col">Danh mục</th>
            <th scope="col">Số lượng kho</th>
            <th scope="col">Số lượng đã bán</th>
            <th scope="col">Hiển thị</th>
            <th scope="col">Sửa</th>
          </tr>
        </thead>
        <tbody>
            <style>
                .tr:hover{
                    background-color: rgb(245, 205, 211);
                }
            </style>

            @foreach ( $list_product as $key => $product)
                <tr class="tr" >
                    <th scope=""><?php echo $key+1;?></th>
                    <td>{{$product->product_name}}</td>
                    <td><img alt="" src="public/uploads/product/{{$product->product_image}}"
                         height="100" width="100"></td>
                    <td>{{$product->product_price}}</td>
                    <td>{{$product->product_desc}}</td>
                    <td>{{$product->cate_name}}</td>
                    <td>{{$product->product_quantity}}</td>
                    <td>{{$product->product_sold}}</td>
                    <td>
                        <?php
                            if ($product->product_status == 0) {
                        ?>
                        <a href="{{URL::to('/off-pro/'.$product->product_id)}}">
                            <span>
                                <i class="fa-regular fa-eye-slash red"></i>
                            </span>
                        </a>
                        <?php
                            } else {
                        ?>
                            <a href="{{URL::to('/on-pro/'.$product->product_id)}}">
                                <span>
                                    <i class="fa-regular fa-eye "></i>
                                </span>
                            </a>
                            <?php
                            }

                        ?>
                        <style>
                            .red{
                                color: red
                            }
                            a{
                                text-decoration: none
                            }
                        </style>
                    </td>
                    <td>
                        <a href="{{URL::to('/edit-product/'.$product->product_id)}}">
                            <i class="fa-solid fa-pen-to-square"></i>

                        </a>

                    </td>
                </tr>
                @endforeach
        </tbody>
      </table>
      <div class="row">
        <div class="col-5">
            <form action="{{ url('/import-product') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="files" accept=".xlsx">
                <input type="submit" value="Chèn file excel " name="import_product" class="btn btn-warning">
            </form>
        </div>
        <div class="col-5">
            <form action="{{ url('/export-product') }}" method="POST" >
                @csrf
                <input type="submit" value="Xuất file excel" name="export_product" class="btn btn-success">
            </form>
        </div>
        <div class="col">
            {{ $list_product->links() }}

        </div>
    </div>
</div>

@endsection
