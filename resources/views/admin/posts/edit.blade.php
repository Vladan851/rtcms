@extends('layouts.admin.default')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit post</h1>
        </div>
    </div>
<div class="row">
    <div class="col-lg-8">
    {!! Form::model($post, ['method'=>'PATCH', 'action'=>['AdminPostController@update', $post->id],'files'=>true]) !!}

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
            {!! Form::select('category_id',['0' => 'Chose category'] + $cat, null, ['class'=>'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::label('published', 'Status:') !!}
            {!! Form::select('published', array(1 => 'Published', 0 => 'Unpublished'), null , ['class'=>'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::label('featured', 'Status:') !!}
            {!! Form::select('featured', array(1 => 'Featured', 0 => 'No featured'), null , ['class'=>'form-control']) !!}
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
            {!! Form::submit('Edit post',['class'=>'btn btn-primary col-sm-6']) !!}
        </div>
    
    {!! Form::close() !!}
    
    {!! Form::open(['method'=>'DELETE', 'action' => ['AdminPostController@destroy', $post->id]]) !!}
        
        <div class="form-group">
            {!! Form::submit('Delete',['class'=>'btn btn-danger col-sm-6']) !!}
        </div>
    
    {!! Form::close() !!}
    
    </div>
     
    <div class="col-lg-4">
        <img src="{{$post->photo ? $post->photo->path : '/images/no-image.jpg'}}" class="img-responsive img-rounded">
    </div>
    
</div>
    

<div class="row">
    <div class="col-lg-12">
        @include('includes.formErrors')
        @include('includes.tinyEditor')
    </div>
</div>

@endsection