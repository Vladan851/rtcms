@extends('layouts.admin.default')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Posts</h1>
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

<table id="example1" style="width:100%" class="table-responsive table-striped table-bordered table-hover display">

    <thead>
        <tr>
            <th>#</th>
            <th>URL</th>
            <th>Owner</th>
            <th>Title</th>
            <th>Category</th>
            <th>Photo</th>
<!--            <th>Content</th>-->
            <th>Published</th>
            <th>Author</th>
            <th>Post link</th>
            <th>Comment link</th>
            <th>Created_at</th>            
            <th>Updated_at</th>
        </tr>
    </thead>

    <tbody>
        @if($posts)
            @foreach($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->url}}</td>
                <td>{{$post->user->name}}</td>
                <td><a href="{{route('posts.edit', $post->id)}}">{{$post->title}}</a></td>
                <td>{{$post->category ? $post->category->name : 'Uncategorized'}}</td>
                <td><img height="50px" src="{{$post->photo ? $post->photo->path : '/images/no-image.jpg'}}"></td>
<!--                <td>{{html_entity_decode($post->content)}}</td>-->
                <td>{{$post->published == 1 ? 'Published' : 'Unpublished'}}</td>
                <td>{{$post->author}}</td>
                <td><a href="{{route('post', $post->slug)}}">View post</a></td>
                <td><a href="{{route('comments.show', $post->id)}}">View comments</a></td>
                <td>{{$post->created_at->diffForHumans()}}</td>
                <td>{{$post->updated_at->diffForHumans()}}</td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>

<!--<div class="row">
    <div class="col-sm-6 col-sm-offset-5">
        

        
    </div>
</div>-->


<button id="btn">Click me</button>

@endsection