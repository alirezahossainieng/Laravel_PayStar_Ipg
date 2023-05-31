@extends('dashboard.app')
@section('main')

  <div class="card">
      <div class="card-header">
        <div class="alert alert-success text-center" role="alert">
            پرداخت موفق
          </div>
      </div>
      <div class="card-body">
        <div class="container">
            <div class="row justify-content-md-center">

              <div class="col-md-auto">
                کدپیگیری <br> {{$order->ref_id}} <br>
                مبلغ <br> {{$order->price}} <br>
                <a href="{{route('index.product')}}">بازگشت به صفحه اصلی</a>
              </div>

            </div>

          </div>
      </div>
  </div>
@endsection
