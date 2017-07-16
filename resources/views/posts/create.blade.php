@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form_div">
            {{Form::label('title', 'Title')}}
            <br />
            {{Form::text('title', '', ['class' => 'form_input', 'placeholder' => 'Title'])}}
            <br />
            {{Form::label('body', 'Body')}}
            <br />
            {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form_input', 'placeholder' => 'Body Text'])}}
            <br />
            {{Form::file('cover_image')}}
            <br />
            {{Form::submit('Submit', ['class' => 'form_submit'])}}
        </div>
    {!! Form::close() !!}

@endsection