@extends('layouts.admin')


@section('content')

    <h1>Edit post</h1>

    <div class="row">
        <div class="col-md-3">

            <img src="{{$post->photo ? $post->photo->name : 'http://placehold.it/200x200'}}" alt=""
                 class="img-responsive img-rounded">
        </div>

        <div class="col-md-9">
            {!! Form::model($post, ['method'=>'PATCH', 'action'=>['AdminPostsController@update',$post->id], 'files' => true]) !!}

            <div class="form-group">
                {!! Form::label('title','Title:') !!}
                {!! Form::text('title',null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('category_id','Category:') !!}
                {!! Form::select('category_id',$categories,null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('photo','Image:') !!}
                {!! Form::file('photo',null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('body','Description:') !!}
                {!! Form::textarea('body',null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Update User',['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}

            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy',$post->id]]) !!}
            <div class="form-group">
                {!! Form::submit('Delete Post',['class'=>'btn btn-danger']) !!}
            </div>
            {!! Form::close() !!}



        </div>
    </div>



    <div class="row">
        @include('includes.form_error')
    </div>


@stop