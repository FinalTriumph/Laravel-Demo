@extends('layouts.app')

@section('content')
    <hr>
    <a href="/posts" class="links_in_post">Go Back</a>
    <hr>
    <h1>{{$post->title}}</h1>
    <div>
        {!!$post->body!!}
    </div>
    <hr>
    <small>Written on {{$post->created_at}}</small>
    <hr>
    <a href="/posts/{{$post->id}}/edit" class="links_in_post">Edit</a>
    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST'])!!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class' => 'delete_post'])}}
    {!!Form::close()!!}

@endsection