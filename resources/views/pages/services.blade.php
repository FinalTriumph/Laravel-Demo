
@extends('layouts.app')

@section('content')

    <h1>{{ $title }}</h1>
    @if(count($services) > 0)
        <ul class="services">
            @foreach($services as $service)
                <li>{{ $service }}</li>
            @endforeach
        </ul>
    @endif

@endsection