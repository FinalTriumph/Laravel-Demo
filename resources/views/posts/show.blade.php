@extends('layouts.app')

@section('content')
    <hr>
    <a href="/posts" class="links_in_post">Go Back</a>
    <hr>
    <div class="post_img_div">
        <img src="/cover_images/{{$post->cover_image}}" />
    </div>
    <h1>{{$post->title}}</h1>
    <div>
        {!!$post->body!!}
    </div>
    <hr>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <hr>
    @if(!Auth::guest() && Auth::user()->id === $post->user_id)
        <a href="/posts/{{$post->id}}/edit" class="links_in_post">Edit</a>
        {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'delete_post'])}}
        {!!Form::close()!!}
    @endif

@endsection