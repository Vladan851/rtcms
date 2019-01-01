@extends('layouts.admin.default')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit cetegories</h1>
    </div>
</div>

<div class="row">
    <div class="flash-message">
        @foreach(['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))
          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
          @endif
        @endforeach
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
    
        {!! Form::model($cat, ['method'=>'PATCH', 'action'=>['AdminCategoriesController@update', $cat->id]]) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::submit('Update category',['class'=>'btn btn-primary col-sm-6']) !!}
        </div>
    
        {!! Form::close() !!}


        {!! Form::open(['method'=>'DELETE', 'action' => ['AdminCategoriesController@destroy', $cat->id]]) !!}
        
        <div class="form-group">
            {!! Form::submit('Delete',['class'=>'btn btn-danger col-sm-6']) !!}
        </div>
    
        {!! Form::close() !!}
        
        @include('includes.formErrors')
        
    </div>
    
</div>

@endsection