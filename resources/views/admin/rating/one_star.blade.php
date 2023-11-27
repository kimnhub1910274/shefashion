@extends('order_rating')
@section('order_rating_content')

    <div class="container">
        <div class="card">
            @foreach($one_star as $key => $re)
            <div class="card-header">
                <span><?php echo $key+1;?>
                    <span style="text-align: center;">
                        <b>#
                        <a href="{{ url('/view-order/'.$re->order_code) }}" target="_blank">{{ $re->order_code }}</a>
                        </b>
                    </span>
                </span>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-2">

                    </div>
                    <div class="col-5">
                        <p>{{ $re->customer_name }}</p>
                        <p style="color:#ffcc00; font-size:15px;">{{ $re->rating }} &#9733;</p>

                        <p style="font-size: 10px; color:#ccc;">{{ $re->review_date }}</p>
                        <p>{{ $re->review }}</p>
                    </div>
                    <div class="col-5">

                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <div>
               {{ $one_star->links() }}
        </div>
    </div>
    <style>
        p{
            margin: -3px 5px
        }
        a{
            text-decoration: none;
            color: #000;
        }
    </style>

@endsection
