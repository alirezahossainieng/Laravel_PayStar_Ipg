@extends('dashboard.app')
@section('main')

  <div class="card">
      <div class="card-header">
        <div class="alert alert-danger text-center" role="alert">
            پرداخت ناموفق
          </div>
      </div>
      <div class="card-body">
        <div class="container">
            <div class="row justify-content-md-center">

              <div class="col-md-auto">
                تراکنش ناموفق درصورت کم شدن پول ظرف 72 ساعت به حساب شما وارییز میگردد
                <a href="{{route('index.product')}}">بازگشت به صفحه اصلی</a>
              </div>

            </div>

          </div>
      </div>
  </div>
@endsection
