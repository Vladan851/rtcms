@extends('layouts.admin.default')

@section('content')


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Media</h1>
    </div>
</div>

{!! Form::open(['method'=>'GET', 'action' => 'AdminMediasController@deleteMedia']) !!}
            
    <div class="form-group">
        <select name="checkBoxArray" id="">
            <option value="delete">Delete</option>
        </select>
    </div>

    <div class="form-group">
        {!! Form::submit('Delete',['class'=>'btn btn-primary', 'name'=>'delete_all']) !!}
    </div>

    <table id="example" style="width:100%" class="table-responsive table-striped table-bordered table-hover display">

        <thead>
            <tr>
                <th><input type="checkbox" id="options"></th>
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
                    <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="{{$photo->id}}"></td>
                    <td>{{$photo->id}}</td>
                    <td><img height="50px" src="{{$photo->path ? $photo->path : '/images/no-image.jpg'}}"></td>
                    <td>{{$photo->created_at ? $photo->created_at->diffForHumans() : 'NO DATE'}}</td>
                    <td>
                        <input type="hidden" name="photo" value="{{$photo->id}}">
                        <div class="form-group">
                            {!! Form::submit('Delete',['class'=>'btn btn-danger', 'name'=>'delete_single']) !!}
                        </div>
                    </td>
                </tr>
                
                @endforeach
               
            @endif
        
        </tbody>

    </table>

{!! Form::close() !!}
 
@endsection

