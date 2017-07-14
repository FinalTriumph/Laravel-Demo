@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert_error">
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert_success">
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert_error">
        {{session('error')}}
    </div>
@endif