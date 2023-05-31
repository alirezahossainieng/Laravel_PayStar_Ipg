@extends('website.app')
@section('main')
<h5 class="text-center">register</h5>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        
    @endforeach
@endif
<form action="{{route('registersubmit')}}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">name</label>
        <input type="name" class="form-control @error('name') is-invalid @enderror " name="name" placeholder="name">
      </div>
      @error('name')
          <p class="bg-danger text-white">{{$error}}</p>
      @enderror
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror " name="email" placeholder="name@example.com">
        @error('email')
        <p class="bg-danger text-white">{{$error}}</p>
    @enderror
      </div>
    <div class="mb-3">
        <label for="password" class="form-label">password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror " name="password" placeholder="password">
        @error('password')
        <p class="bg-danger text-white">{{$error}}</p>
    @enderror
      </div>
    <div class="mb-3 text-center">
        <input type="submit" value="register" class="btn btn-primary">
          
      </div>

</form>
  
@endsection
