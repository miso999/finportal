@extends('layouts.admin')


@section('content')


    @if(Session::has('deleted_comment_msg'))

        <div class="bg-danger">{{session('deleted_comment_msg')}}</div>
    @endif
    <h1>Comments</h1>

    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Email</th>
            <th>Body</th>
        </tr>
        </thead>
        <tbody>
        @if(count($comments))
            @foreach($comments as $comment)
                <tr>
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->user->name}}</td>
                    <td>{{$comment->email}}</td>
                    <td>{{$comment->body}}</td>
                    <td><a href="{{route('home.post',$comment->postSlug())}}">View post</a></td>
                    <td>
                        @if(!$comment->is_active)
                            {!! Form::open(['method'=>'PATCH','action'=>['PostCommentsController@update', $comment->id]]) !!}

                            @if($comment->comment_id)
                                <input type="hidden" name="is_reply" value="1">
                            @endif
                            <input type="hidden" name="is_active" value="1">
                            <div class="form-group">
                                {!! Form::submit('Approve',['class'=>'btn btn-info']) !!}
                            </div>
                            {!! Form::close() !!}


                        @else
                            {!! Form::open(['method'=>'PATCH','action'=>['PostCommentsController@update', $comment->id]]) !!}
                            <input type="hidden" name="is_active" value="0">
                            @if($comment->comment_id)
                                <input type="hidden" name="is_reply" value="1">
                            @endif
                            <div class="form-group">
                                {!! Form::submit('Un-approve',['class'=>'btn btn-success']) !!}
                            </div>
                            {!! Form::close() !!}
                        @endif

                    </td>

                    <td align="left">
                        {!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentsController@destroy', $comment->id]]) !!}

                        @if($comment->comment_id)
                            <input type="hidden" name="is_reply" value="1">
                        @endif
                        <div class="form-group">
                            {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                        </div>

                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

@stop