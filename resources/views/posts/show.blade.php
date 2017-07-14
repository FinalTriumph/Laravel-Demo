@extends('layouts.app')

@section('content')
    <hr>
    <a href="/posts" class="go_back">Go Back</a>
    <hr>
    <h1>{{$post->title}}</h1>
    <div>
        {!!$post->body!!}
    </div>
    <hr>
    <small>Written on {{$post->created_at}}</small>

@endsection