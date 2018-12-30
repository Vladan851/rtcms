@extends('layouts.admin.default')

@section('content')

<div class="row">
    <div class="col-lg-12">
    <h1 class="page-header">Create post</h1>
</div>
</div>
    
<div class="row">
    <div class="col-lg-8">
    {!! Form::open(['method'=>'POST', 'action'=>'AdminPostController@store','files'=>true]) !!}

        <div class="form-group">
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title', null, ['class'=>'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::label('source', 'Source:') !!}
            {!! Form::text('source', null, ['class'=>'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::label('author', 'Author:') !!}
            {!! Form::text('author', null, ['class'=>'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::label('category_id', 'Category:') !!}
            {!! Form::select('category_id',['' => 'Chose category'] + $cat, null, ['class'=>'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::label('published', 'Status:') !!}
            {!! Form::select('published', array(1 => 'Published', 0 => 'Unpublished'), 0 , ['class'=>'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::label('featured', 'Status:') !!}
            {!! Form::select('featured', array(1 => 'Featured', 0 => 'No featured'), 0 , ['class'=>'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::label('photo_id', 'Photo:') !!}
            {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::label('content', 'Content:') !!}
            {!! Form::textarea('content', null, ['class'=>'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::submit('Create post',['class'=>'btn btn-primary']) !!}
        </div>
    
    {!! Form::close() !!}
    
    @include('includes.formErrors')
     
    @include('includes.tinyEditor')
    
    </div>
 
</div>


@endsection