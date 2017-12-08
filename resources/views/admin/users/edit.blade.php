@extends('layouts.admin')


@section('content')

    <h1>Edit user</h1>

    <div class="row">
        <div class="col-md-3">

            <img src="{{$user->photo ? $user->photo->name : 'http://placehold.it/200x200'}}" alt=""
                 class="img-responsive img-rounded">
        </div>

        <div class="col-md-9">
            {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update',$user->id], 'files' => true]) !!}

            <div class="form-group">
                {!! Form::label('name','Name:') !!}
                {!! Form::text('name',null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('email','Email:') !!}
                {!! Form::email('email',null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('role_id','Role:') !!}
                {!! Form::select('role_id',$roles, null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('is_active','Status:') !!}
                {!! Form::select('is_active',['1'=>'Active','0'=>'Not active'],null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('password','Password:') !!}
                {!! Form::password('password',['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('photo','Image:') !!}
                {!! Form::file('photo',null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Update User',['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

<div class="row">
    {!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy', $user->id]]) !!}


    <div class="form-group">
        {!! Form::submit('Delete User',['class'=>'btn btn-danger']) !!}
    </div>

    {!! Form::close() !!}
</div>

    <div class="row">
        @include('includes.form_error')
    </div>


@stop