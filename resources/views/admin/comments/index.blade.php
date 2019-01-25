@extends('layouts.admin.default')


@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Comments</h1>
    </div>
</div>

@if(count($comments))

<table id="example" style="width:100%" class="table-responsive table-striped table-bordered table-hover display">

    <thead>
        <tr>
            <th>#</th>
            <th>Author</th>
            <th>Email</th>
            <th>Body</th>
            <th>Created_at</th>            
            <th>Is active</th>
            <th>Post</th>
            <th>View</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @if($comments)
            @foreach($comments as $comment)
            <tr>
                <td>{{$comment->id}}</td>
                <td>{{$comment->author}}</td>
                <td>{{$comment->email}}</td>
                <td>{{$comment->body}}</td>
                <td>{{$comment->created_at->diffForHumans()}}</td>
                <td>{{$comment->is_active == 1 ? 'Published' : 'Unpublished'}}</td>
                <td><a href="{{route('post', $comment->post->slug)}}">View post</a></td>
                <td><a href="{{route('comments.show', $comment->id)}}">View comment</a></td>
                <td>
                    
                    @if($comment->is_active == 1)
                    {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]])!!}
                    <input type="hidden" name="is_active" value="0">
                    <div class="form-group">
                        {!! Form::submit('Un-approve', ['class'=>'btn btn-success btn-block']) !!}
                    </div>
                    {!! Form::close() !!}
                    
                    @else
                    {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]])!!}
                    <input type="hidden" name="is_active" value="1">
                    <div class="form-group">
                        {!! Form::submit('Approve', ['class'=>'btn btn-info btn-block']) !!}
                    </div>
                    {!! Form::close() !!}
                    
                    @endif
                    
                    {!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentsController@destroy', $comment->id]])!!}
                    <div class="form-group">
                        {!! Form::submit('Delete', ['class'=>'btn btn-danger btn-block']) !!}
                    </div>
                    {!! Form::close() !!}
                    
                </td>
            </tr>
            @if($comment->replies)
                @foreach($comment->replies as $reply)
                <tr>
                    <td>{{$reply->id}}</td>
                    <td>{{$reply->author}}</td>
                    <td>{{$reply->email}}</td>
                    <td>{{$reply->body}}</td>
                    <td>{{$reply->created_at->diffForHumans()}}</td>
                    <td>{{$reply->is_active == 1 ? 'Published' : 'Unpublished'}}</td>
                    <td><a href="{{route('post', $comment->post->id)}}">View post</a></td>
                    <td><a href="{{route('comments.show', $comment->id)}}">View comment</a></td>
                    <td>
                        @if($reply->is_active == 1)
                        {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]])!!}
                        <input type="hidden" name="is_active" value="0">
                        <div class="form-group">
                            {!! Form::submit('Un-approve', ['class'=>'btn btn-success btn-block']) !!}
                        </div>
                        {!! Form::close() !!}

                        @else
                        {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]])!!}
                        <input type="hidden" name="is_active" value="1">
                        <div class="form-group">
                            {!! Form::submit('Approve', ['class'=>'btn btn-info btn-block']) !!}
                        </div>
                        {!! Form::close() !!}

                        @endif

                        {!! Form::open(['method'=>'DELETE', 'action'=>['CommentRepliesController@destroy', $reply->id]])!!}
                        <div class="form-group">
                            {!! Form::submit('Delete', ['class'=>'btn btn-danger btn-block']) !!}
                        </div>
                        {!! Form::close() !!}
                </tr>
                @endforeach
            @endif
            @endforeach
        @endif
    </tbody>
</table>

@else

    <h1 class="text-center">No comments</h1>

@endif

@stop