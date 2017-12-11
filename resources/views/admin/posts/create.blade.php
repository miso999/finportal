@extends('layouts.admin')


@section('content')

    <h1>Create post</h1>

    {!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@store', 'files' => true]) !!}

    <div class="form-group">
        {!! Form::label('title','Title:') !!}
        {!! Form::text('title',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('category_id','Category:') !!}
        {!! Form::select('category_id',[''=>'Choose category'] + $categories,null,['class'=>'form-control']) !!}
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
        {!! Form::submit('Create Post',['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}


    @include('includes.form_error')

@stop