@extends('dashboard.app')
@section('main')
<div class="card">
    <div class="card-header">
        product index
        <a href="{{route('product.create')}}">add product</a>
        @if (session('message'))
            <h6 class="text-center">{{session('message')}}</h6>
        @endif
    </div>
    <div class="caed-body">
        <table class="table table-bordered table-striped  ">
            <tr>
                <td>id</td>
                <td>title</td>
                <td>body</td>
                <td>price</td>
                <td>image</td>
                <td>action</td>
                
            </tr>
            @foreach ($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->title}}</td>
                    <td>{{$product->body}}</td>
                    <td>{{$product->price}}</td>
                    
                    <td><img src="{{asset('assets/images/'.$product->image)}}" alt="" width="220px"></td>
                    
                    <td><a href="{{route('product.edit', ['product'=>$product->id])}}" class="btn btn-primary">update</a> 
                        {!! Form::open(['route'=>['product.destroy',$product->id] ,'method'=>'delete']) !!}
                        {!! Form::submit('delete',['class'=>'btn btn-danger']) !!}
                        {!! Form::close() !!}
                        
                        
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection