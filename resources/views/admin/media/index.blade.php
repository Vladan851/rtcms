@extends('layouts.admin.default')

@section('content')


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Media</h1>
    </div>
</div>


<table id="example" style="width:100%" class="table-responsive table-striped table-bordered table-hover display">
        
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Added date</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
            
            @if($photos)
                @foreach($photos as $photo)
                <tr>
                    <td>{{$photo->id}}</td>
                    <td><img height="50px" src="{{$photo->path ? $photo->path : '/images/no-image.jpg'}}"></td>
                    <td>{{$photo->created_at ? $photo->created_at->diffForHumans() : 'NO DATE'}}</td>
                    <td>
                        
                        {!! Form::open(['method'=>'DELETE', 'action' => ['AdminMediasController@destroy', $photo->id]]) !!}
        
                            <div class="form-group">
                                {!! Form::submit('Delete',['class'=>'btn btn-danger col-sm-6']) !!}
                            </div>

                        {!! Form::close() !!}
                        
                    </td>
                </tr>
                @endforeach
            @endif
        
        </tbody>
        
    </table>

@endsection

