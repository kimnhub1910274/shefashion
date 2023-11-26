@extends('check')
@section('check_content')

<div class="container-fluid card">
    &nbsp;
    <?php
    $message = Session::get('message');
    if ($message) {
        echo $message;
        Session::pull('message', null);
    }
?>  <div id="notify_comment"></div>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên</th>
            <th scope="col">Bình luận</th>
            <th scope="col">Sản phẩm </th>
            <th scope="col">Ngày</th>
            <th scope="col">Duyệt </th>
            <th scope="col">Quản lý</th>
          </tr>
        </thead>
        <tbody>
            <style>
                .red{
                    color: rgb(125, 18, 18)
                }
                a{
                    text-decoration: none
                }
            </style>
            @foreach ( $comment as $key => $comm)
            <tr>
                <span style="color:black;">
                    <b>
                        <?php
                        $name =  Auth::user()->admin_name;
                    if($name){
                        //    echo $name;
                         }
                        ?>
                    </b>
                </span>
                <th scope=""><?php echo $key+1;?></th>
                <td>{{$comm->comment_user}}</td>
                <td>{{$comm->comment}}
                    <ul style="color: rgb(41, 41, 184); list-style-type:none">
                        @foreach($comment_rpl as $key => $com_rpl)
                            @if ($com_rpl->comment_parent_comment == $comm->comment_id)
                            <li>{{ $com_rpl->comment_user }}: {{ $com_rpl->comment }}</li>
                            @endif

                        @endforeach

                    </ul>
                    @if ($comm->comment_status == 1 && $comm->comment_user != 'Admin')
                    <p>
                        <textarea name="" id="" cols="" rows="2"
                        class="reply_comment_{{$comm->comment_id}} form-control"></textarea>
                        <button class="btn btn-default btn_reply_comment"
                        data-product_id="{{$comm->comment_product_id}}"
                         data-comment_id = "{{$comm->comment_id}}">Trả lời</button>

                    </p>
                    @endif
                </td>
                <td><a href="{{ url('/product-detail/'.$comm->product->product_id) }}"
                     style="text-decoration: none; color:black"
                     target="_blank">{{$comm->product->product_name}}</a>
                </td>
                <td>{{$comm->comment_date}}</td>

                <td>
                    @if ($comm->comment_status == 0)
                        <input type="button" data-comment_id = "{{$comm->comment_id}}"
                        data-comment_status = "1"
                         id="{{$comm->comment_product_id}}"
                         class="btn btn-success btn-xs btn_comment_status" value="Duyệt">
                    @elseif($comm->comment_status == 1)
                        <input type="button" data-comment_id = "{{$comm->comment_id}}"
                        data-comment_status = "0"
                        id="{{$comm->comment_product_id}}"
                        class="btn btn-danger btn-xs btn_comment_status" value="Bỏ duyệt">
                    @endif
                </td>

                <td>

                    <a href="{{URL::to('/')}}">
                        <i class="fa-solid fa-pen-to-square"></i>

                    </a>
                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận
                     ?')"href="{{URL::to('/comment-delete/')}}">
                        <i class="fa-solid fa-trash red"></i>

                    </a>
                </td>
            </tr>
            @endforeach

        </tbody>
      </table>
      <div style="float: right">
        {{ $comment->links() }}
      </div>

</div>



@endsection
