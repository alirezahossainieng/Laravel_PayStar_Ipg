@extends('website.app')
@section('main')
<div class="container text-center">
   <div class="row">
@foreach ($products as $product)
<div class="col-md-4 mt-4">
  <div class="card " style="width: 18rem;">
     <img src="{{asset('assets/images/'.$product->image)}}" class="card-img-top indeximg" alt="...">
     <div class="card-body">
       <h5 class="card-title">{{$product->title}}</h5>
       <p class="card-text">{{$product->body}}</p>
       <hr>
       <div class="footer">
         <div class="left"><a href="{{route('show.product',['id'=>$product->id])}}" class="btn btn-primary">detail</a>
         </div>


          <div class="right"><p>{{$product->price}}</p></div>
       </div>

     </div>
   </div>
 </div>
@endforeach





   </div>
 </div>

@endsection
