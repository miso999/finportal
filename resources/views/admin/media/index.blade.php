@extends('layouts.admin')

@section('content')

    <h1>Media</h1>


    @if(count($photos))
        <table class="table">
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Create date</td>
            </tr>
            @foreach($photos as $photo)
                <tr>
                    <td>{{$photo->id}}</td>
                    <td><img height="200" src="{{$photo->name ? $photo->name : 'https://placehold.it/200x200/'}}"></td>
                    <td>{{$photo->created_at->diffForHumans()}}</td>
                    <td>
                        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediasController@destroy',$photo->id]]) !!}

                        <div class="form-group">
                            {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                        </div>

                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

@stop