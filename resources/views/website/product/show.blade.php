@extends('website.app')
@section('main')

<div class="product">
  <div class="header">
    <a href="{{route('index.product')}}"><div class="back"></div>
    </div></a>
  <div class="main">
    <div class="left">
      <h1>{{$product->title}}</h1>
      <h2>{{$product->body}}</h2>
      
    </div>
    <div class="right mt-3 mb-3">
      <img src="{{asset('assets/images/'.$product->image)}}" style="margin-bottom: 20px !important" />
      
      {{-- <p>In stock. </p> --}}
      
      {{-- <p class="quantity">qty:<span class="fa fa-angle-left angle"></span><span id="qt">3</span><span class="fa fa-angle-right angle"></span></p> --}}
    </div>
  </div>
  <div class="footer">
    <div class="left mt-3"><h3>{{$product->price}}$</h3></div>
    <div class="right"> 
      
      <form action="{{route('addproduct', ['product'=>$product->id])}}" method="post">
      @csrf
      
      <input type="submit" value="add to cart" class="btn btn-primary">
    </form>
    </div>
  </div>
</div>


@endsection
@section('script')
    <script>

    </script>
@endsection