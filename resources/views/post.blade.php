@extends('layouts.blog-post')

@section('content')
    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo ? $post->photo->name : 'http://placehold.it/900x300'}}" alt="">

    <hr>

    <!-- Post Content -->
    {{$post->body}}
    <hr>

    @if(Session::has('comment_message'))
        {{session('comment_message')}}
    @endif
    <!-- Blog Comments -->

    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>
        {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!}

        <input type="hidden" name="post_id" value="{{$post->id}}">
        <div class="form-group">
            {!! Form::textarea('body',null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>

    <hr>

    <!-- Posted Comments -->

    @if($post->comments)
        @foreach($post->comments()->whereIsActive(1)->get() as $comment)
            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img width="64px" class="media-object"
                         src="{{$comment->user->photo ? $comment->user->photo->name : 'http://placehold.it/64x64'}}"
                         alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->user->name}}
                        <small>{{$comment->created_at->diffForHumans()}}</small>
                    </h4>
                {{$comment->body}}


                @if(count($comment->replies))
                    @foreach($comment->replies()->whereIsActive(1)->get() as $reply)
                        <!-- Nested Comment -->
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img width="64px" class="media-object"
                                         src="{{$reply->user->photo ? $reply->user->photo->name : 'http://placehold.it/64x64'}}"
                                         alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">{{$reply->user->name}}
                                        <small>{{$reply->created_at->diffForHumans()}}</small>
                                    </h4>
                                    {{$reply->body}}
                                </div>
                            </div>
                            <!-- End Nested Comment -->
                        @endforeach
                    @endif

                    {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}

                    <input type="hidden" name="comment_id" value="{{$comment->id}}">
                    <div class="form-group">
                        {!! Form::textarea('body',null,['class'=>'form-control', 'rows' => 1]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        @endforeach
    @endif




@stop