@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>
    {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST']) !!}
        <div class="form_div">
            {{Form::label('title', 'Title')}}
            <br />
            {{Form::text('title', $post->title, ['class' => 'form_input', 'placeholder' => 'Title'])}}
            <br />
            {{Form::label('body', 'Body')}}
            <br />
            {{Form::textarea('body', $post->body, ['id' => 'article-ckeditor', 'class' => 'form_input', 'placeholder' => 'Body Text'])}}
            <br />
            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Submit', ['class' => 'form_submit'])}}
        </div>
    {!! Form::close() !!}

@endsection