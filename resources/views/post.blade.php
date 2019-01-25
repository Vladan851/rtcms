@extends('layouts.blog-post')

@section('content')

<h1>{{$post->title}}</h1>
<p class="lead">
    by <a href="#">{{$post->user->name}}</a>
</p>
<p><span class="glyphicon glyphicon-time">Posted at: {{$post->created_at->diffForHumans()}}</span></p>

{!! html_entity_decode($post->content) !!}

    <div class="flash-message">
        @foreach(['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))
          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
          @endif
        @endforeach
    </div>



@stop

@section('comments')

  @if(count($comments) > 0)

    @foreach($comments as $comment)
        <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
                <h5 class="mt-0">{!!$comment->author!!}<span> {!! $comment->created_at->diffForHumans() !!}</span></h5>
                <p>{!!$comment->body!!}</p>

                @if(count($comment->replies) > 0)

                    @foreach($comment->replies as $reply)

                        @if($reply->is_active == 1)

                            <div class="media mt-4">
                                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                                <div class="media-body">
                                    <h5 class="mt-0">{!!$reply->author!!}</h5>
                                    <p>{!!$reply->body!!}</p>
                                </div>
                            </div>

                        @endif

                    @endforeach

                @endif

                <div class="comment-reply-container">                

                    <button class="toggle-reply btn btn-primary pull-right">Reply</button>
                    
                    <div class="comment-reply col-sm-12">  

                        {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@store'])!!}
                            <input type="hidden" name="comment_id" value="{!!$comment->id!!}">
                                <div class="form-group">
                                    {!! Form::label('body', 'Body:') !!}
                                    {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>'3']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::submit('Leave reply', ['class'=>'btn btn-primary']) !!}
                                </div>
                        {!! Form::close() !!}
                    
                    </div>

                </div>

          </div>

        </div>
    @endforeach

    @else
        <h1 class="text-center">No comments</h1>
@endif
  
@stop


@section('categories')
    @if($cats)
        @foreach($cats as $cat)
            <li>
                <a href="#">{{$cat->name}}</a>
            </li>
        @endforeach
    @endif   
@stop


@section('scripts')

    <script>
        
        $(".comment-reply-container .toggle-reply").click(function(){
            
            $(this).next().slideToggle("slow");
            
        });

    </script>

@stop