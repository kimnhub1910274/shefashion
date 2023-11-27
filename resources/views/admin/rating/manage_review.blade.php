@extends('order_rating')
@section('order_rating_content')

    <div class="container">
        <div class="card">
            @foreach($review as $key => $re)
            <div class="card-header">
                <p><?php echo $key+1;?></p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-2">

                    </div>
                    <div class="col-5">
                        <p>{{ $re->customer_id }}</p>
                        <p>{{ $re->rating->rating }}</p>
                        <p>{{ $re->review_date }}</p>
                        <p>{{ $re->order_id}}</p>
                        <p>{{ $re->review }}</p>
                    </div>
                    <div class="col-5">

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

@endsection
