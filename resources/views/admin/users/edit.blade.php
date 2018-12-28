@extends('layouts.admin.default')

@section('content')

<div class="row">
    <div class="col-lg-12">
    <h1 class="page-header">Edit user</h1>
    </div>
</div>
    
<div class="row">
    <div class="col-lg-6">
    {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id],'files'=>true]) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::label('email', 'Email:') !!}
            {!! Form::email('email', null, ['class'=>'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::label('role_id', 'Role:') !!}
            {!! Form::select('role_id',['' => 'Chose options'] + $roles, null, ['class'=>'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::label('is_active', 'Status:') !!}
            {!! Form::select('is_active', array(1 => 'Active', 0 => 'Not active'), null , ['class'=>'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::label('photo_id', 'Photo:') !!}
            {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
        </div>
    
<!--        <div class="form-group">
            {!! Form::label('content', 'Content:') !!}
            {!! Form::textarea('content', null, ['class'=>'form-control']) !!}
        </div>-->
    
        <div class="form-group">
            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password', ['class'=>'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::submit('Edit user',['class'=>'btn btn-primary col-sm-6']) !!}
        </div>
    
    {!! Form::close() !!}
    
    {!! Form::open(['method'=>'DELETE', 'action' => ['AdminUsersController@destroy', $user->id]]) !!}
        
        <div class="form-group">
            {!! Form::submit('Delete',['class'=>'btn btn-danger col-sm-6']) !!}
        </div>
    
    {!! Form::close() !!}
    
    </div>
     
    <div class="col-lg-6">
        <img src="{{$user->photo ? $user->photo->path : '/images/no-image.jpg'}}" class="img-responsive img-rounded">
    </div>
    
</div>

<div class="row">
    <div class="col-lg-12">
        @include('includes.formErrors')
        <!--@include('includes.tinyEditor')-->
    </div>
</div>
    
@endsection