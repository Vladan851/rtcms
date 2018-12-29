@extends('layouts.admin.default')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Posts</h1>
    </div>
</div>

<div class="row">
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))
          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
          @endif
        @endforeach
    </div>
</div>

<table id="example" style="width:100%" class="table-responsive table-striped table-bordered table-hover display">

    <thead>
        <tr>
            <th>#</th>
            <th>URL</th>
            <th>Title</th>
            <th>Published</th>
            <th>Author</th>
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
                <td><a href="{{route('posts.edit', $post->id)}}">{{$post->title}}</a></td>
                <td>{{$post->published == 1 ? 'Published' : 'Unpublished'}}</td>
                <td>{{$post->author}}</td>
                <td>{{$post->created_at->diffForHumans()}}</td>
                <td>{{$post->updated_at->diffForHumans()}}</td>
            </tr>
            @endforeach
        @endif
    </tbody>

</table>

@endsection