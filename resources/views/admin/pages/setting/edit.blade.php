@extends('admin.dashboard')
@section('title')
    Edit Setting
@endsection
@section('content')
    @if(!$record)
        <div class="alert alert-warning">
            whoops! : You don`t have Settings.
        </div>
    @endif

    {!! Form::open(['method' => 'POST', 'action' => ['SettingController@update', $record->id]]) !!}
    <div class="row">
    <div class="form-group col-md-6">
        {{Form::label('email', 'E mail' )}}
        {{Form::text('email', $record->email, ['class' => 'form-control'])}}
    </div>
    <div class="form-group col-md-6">
        {{Form::label('play_store_url', 'Play Store Link' )}}
        {{Form::text('play_store_url', $record->play_store_url, ['class' => 'form-control'])}}
    </div>
    <div class="form-group col-md-6">
        {{Form::label('app_store_url', 'Ios Store Link' )}}
        {{Form::text('app_store_url', $record->app_store_url, ['class' => 'form-control'])}}
    </div>
    <div class="form-group col-md-6">
        {{Form::label('fb_link', 'FaceBook Link' )}}
        {{Form::text('fb_link', $record->fb_link, ['class' => 'form-control'])}}
    </div>
    <div class="form-group col-md-6">
        {{Form::label('youtube_link', 'Youtube Link' )}}
        {{Form::text('youtube_link', $record->youtube_link, ['class' => 'form-control'])}}
    </div>
    <div class="form-group col-md-6">
        {{Form::label('twt_link', 'Twitter Link' )}}
        {{Form::text('twt_link', $record->twt_link, ['class' => 'form-control'])}}
    </div>
    <div class="form-group col-md-6">
        {{Form::label('insta_link', 'Instagram Link' )}}
        {{Form::text('insta_link', $record->insta_link, ['class' => 'form-control'])}}
    </div>

    <div class="form-group col-md-6"></div>

    <div class="form-group col-md-6">
        {{Form::label('about_app', 'About App' )}}
        {{Form::textarea('about_app', $record->about_app, ['class' => 'form-control'])}}
    </div>
    <div class="form-group col-md-6">
        {{Form::label('about_us', 'About Us' )}}
        {{Form::textarea('about_us', $record->about_us, ['class' => 'form-control'])}}
    </div>
    </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Edit', ['class' => 'btn btn-info'])}}

    {!! Form::close() !!}

@endsection
