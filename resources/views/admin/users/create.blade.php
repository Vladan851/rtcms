@extends('layouts.admin.default')

@section('content')

<div class="row">
    <div class="col-lg-12">
    <h1 class="page-header">Create user</h1>
</div>
</div>
    
<div class="row">
    <div class="col-lg-6">
    {!! Form::open(['method'=>'POST', 'action'=>'AdminUsersController@store','files'=>true]) !!}

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
            {!! Form::select('is_active', array(1 => 'Active', 0 => 'Not active'), 0 , ['class'=>'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::label('file', 'File:') !!}
            {!! Form::file('file', null, ['class'=>'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::label('content', 'Content:') !!}
            {!! Form::textarea('content', null, ['class'=>'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password', ['class'=>'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::submit('Create user',['class'=>'btn btn-primary']) !!}
        </div>
    
    {!! Form::close() !!}
    
     @include('includes.formErrors')
     @include('includes.tinyEditor')
    
    </div>
</div>


@endsection