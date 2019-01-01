@extends('layouts.admin.default')

@section('styles')

@stop


@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Upload media</h1>
    </div>
</div>


<div class="row">
    <div class="col-lg-6">
        
        {!! Form::open(['method'=>'POST', 'action' => 'AdminMediasController@store', 'class' => 'dropzone']) !!}
    
        {!! Form::close() !!}
        
    </div>
</div>
    
@stop


@section('scripts')

@stop