@extends('dashboard.app')
@section('main')
<div class="card">
    <div class="card-header">
        <h4>product</h4>
        @if (session('message'))
            <h6 class="text-center">{{session('message')}}</h6>
        @endif
    </div>
    <div class="card-body">
        @if ($errors->any())
          @foreach ($errors->all() as $error)
          <h6>{{$error}}</h6>
          @endforeach
        @endif
        <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title">title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="image">image</label>
                    <input type="file" name="image" class="form-control">
                </div>
            
                
                <div class="col-md-6 mb-3">
                    <label for="price">price</label>
                    <input type="text" name="price" class="form-control">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="body">body</label>
                    <textarea name="body" id="" cols="30" rows="4" class="form-control"></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <input type="submit" value="create" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>
    
@endsection