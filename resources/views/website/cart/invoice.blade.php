@extends('dashboard.app')
@section('main')
<div class="card">
    <div class="card-header">
        cart index
        <div class="col-3 ">
            @if (session('message'))
            <h6 class="text-center bg-danger text-white">{{session('message')}}</h6>
        @endif
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped  ">
            <tr>
                <td>num</td>
                <td>product</td>
                <td>qty</td>
                <td>count</td>
                <td>unitprice</td>
                <td>totalprice</td>


            </tr>
            @foreach ($cart->products as $key=>$item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td><img src="{{asset('assets/images/'.$item['product']->image)}}" alt="" width="220px"></td>
                    <td >

                        {!! Form::open(['route'=>['updatecart',$item['product']->id] ,'method'=>'put']) !!}
                        {!! Form::text('qty', $value=$item['count'], ['class'=>'form-control','readonly']) !!}
                        {{-- {!! Form::hidden('prodid', $value=$item['product']->id) !!} --}}
                            {!! Form::close() !!}
                    </td>

                    <td>{{$item['count']}}</td>
                    <td>{{$item['product']->price}}</td>
                    <td>{{$item['product']->price * $item['count']}}</td>



                </tr>
            @endforeach
        </table>
        <table class="table table-bordered table-striped  ">
            <tr>
                <td>total price</td>
                <td>count</td>
            </tr>
            <tr>
                <td>{{$cart->price}}</td>
                <td>{{$cart->count}}</td>
            </tr>
        </table>
        {!! Form::open(['route'=>'invoice' , 'method'=>'post']) !!}

        {!! Form::text('address', $value=$cart->address, ['class'=>'form-control','readonly']) !!}

        {!! Form::close() !!}
        <a href="{{route('orderstore')}}" class="btn btn-primary">next</a>
    </div>
</div>
@endsection
