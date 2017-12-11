@extends('layouts.admin')

@section('content')

    @if(Session::has('updated_msg'))

        <div class="bg-danger">{{session('updated_msg')}}</div>
    @endif
    <h1>Categories</h1>

    <div class="col-md-6">
        {!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store']) !!}

        <div class="form-group">
            {!! Form::label('name','Category name:') !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

        <div class="row">
            @include('includes.form_error')
        </div>
    </div>


    <div class="col-md-6">
        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
            </thead>
            <tbody>
            @if(count($categories))
                @foreach($categories as $category)
                    <tr>
                        <td><a href="{{route('admin.categories.edit', $category->id)}}">{{$category->id}}</a></td>
                        <td><a href="{{route('admin.categories.edit', $category->id)}}">{{$category->name}}</a></td>
                        <td>{{$category->created_at ? $category->created_at->diffForHumans() : ''}}</td>
                        <td>{{$category->updated_at ? $category->updated_at->diffForHumans() : ''}}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>

    </div>

@stop