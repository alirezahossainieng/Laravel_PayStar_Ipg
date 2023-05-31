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
        
        {!! Form::model($product, ['route' => ['product.update', $product->id],'method'=>'put','files'=>true]) !!}

            <div class="row">
                <div class="col-md-6 mb-3">
                    {!! Form::label('title', 'title') !!}
                    {!! Form::text('title',$value=null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="col-md-6 mb-3">
                    {!! Form::label('price', 'price') !!}
                    {!! Form::text('price',$value=null, ['class' => 'form-control']) !!}
                </div>
                
               
                <div class="col-md-6 mb-3">
                    {!! Form::textarea('body', $value=null, ['class' => 'form-control']) !!}
                </div>
                
                <div class="col-md-6 mb-3">
                    {!! Form::label('image', 'image') !!}
                    {!! Form::file('image', ['class'=>'form-control']) !!}
                </div>
                
                
                
                <div class="col-md-6 mb-3">
                    {!! Form::submit('update', ['class'=>'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
               
            
        
    </div>
</div>


    

@endsection