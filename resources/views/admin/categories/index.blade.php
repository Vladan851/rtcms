@extends('layouts.admin.default')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Cetegories</h1>
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
        
        <h3>Create new:</h3>
    
        {!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::submit('Create category',['class'=>'btn btn-primary']) !!}
        </div>
    
    {!! Form::close() !!}
    
        @include('includes.formErrors')
        
    </div>
    
    
    
    <div class="col-sm-6">
        
    <h3>Category list:</h3>
        
    <table id="example" style="width:100%" class="table-responsive table-striped table-bordered table-hover display">
        
        <thead>
            <tr>
                <th>#</th>
                <th>Category</th>
                <th>Created date</th>
            </tr>
        </thead>

        <tbody>
            
            @if($cats)
                @foreach($cats as $cat)
                <tr>
                    <td>{{$cat->id}}</td>
                    <td><a href="{{route('categories.edit', $cat->id)}}">{{$cat->name}}</a></td>
                    <td>{{$cat->created_at ? $cat->created_at->diffForHumans() : 'NO DATE'}}</td>
                </tr>
                @endforeach
            @endif
        
        </tbody>
        
    </table>
        
    </div>
    
</div>

@endsection