@extends('admin_dashboard')
@section('admin_content')

<div class="container-fluid card">
    &nbsp;
    <h3>DANH SÁCH SẢN PHẨM</h3>
    <?php
    $message = Session::get('message');
    if ($message) {
        echo $message;
        Session::pull('message', null);
    }
?>
    <table class="table">
        <thead>
          <tr>
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

            @foreach ( $list_product as $key => $product)
                <tr>
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
                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục
                        {{$product->product_name}} ?')"href="{{URL::to('/delete-product/'.$product->product_id)}}">
                            <i class="fa-solid fa-trash red"></i>

                        </a>
                    </td>
                </tr>
            @endforeach

        </tbody>
      </table>
</div>

@endsection
