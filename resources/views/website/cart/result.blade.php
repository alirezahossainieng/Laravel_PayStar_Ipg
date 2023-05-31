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
       <h1>thancks for buying</h1>
    </div>
</div>
@endsection