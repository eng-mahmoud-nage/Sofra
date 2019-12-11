@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@elseif(session('warning'))
    <div class="alert alert-warning">
        {{session('warning')}}
    </div>
@elseif(session('danger'))
    <div class="alert alert-danger">
        {{session('danger')}}
    </div>
@endif
