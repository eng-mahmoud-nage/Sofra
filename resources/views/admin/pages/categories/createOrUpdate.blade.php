@extends('admin.dashboard')
@section('content')
    @section('title')
{{--        @dd(empty($record), $record->name)--}}
    @if(!empty($record) && $record->name == null)
{{--        @dd('create')--}}
        New User
        {!! Form::open(['method' => 'POST', 'action' => 'CategoryController@store']) !!}
    @else
{{--        @dd('update')--}}
        Edit User
        {!! Form::open(['method' => 'POST', 'action' => ['CategoryController@update', $record->id]]) !!}
    @endif
    @endsection
        <div class="form-group">
            {{Form::label('name', 'Name' )}}
            {{Form::text('name', $record->name, ['class' => 'form-control'])}}
        </div>
    @if(!empty($record) && $record->name == null)
        {{Form::submit('Add', ['class' => 'btn btn-primary'])}}
        {{Form::submit('Add More', ['class' => 'btn btn-info'])}}
    @else
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Edit', ['class' => 'btn btn-info'])}}
    @endif
    {!! Form::close() !!}
@endsection
