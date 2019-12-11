@inject('role', "Spatie\Permission\Models\Role")
@extends('admin.dashboard')
@section('content')
    @section('title')
    @if(!empty($record) && $record->name == null)
        New Permissions
        {!! Form::open(['method' => 'POST', 'action' => 'Role\PermissionController@store']) !!}
    @else
        Edit Permissions
        {!! Form::open(['method' => 'POST', 'action' => ['Role\PermissionController@update', $record->id]]) !!}
    @endif
    @endsection
    <div class="form-group">
        {{Form::label('name', 'Name' )}}
        {{Form::text('name', $record->name, ['class' => 'form-control'])}}
    </div>
    <div class="form-group">
        {{Form::label('guard_name', 'Guard Name' )}}
        {{Form::text('guard_name', $record->guard_name, ['class' => 'form-control'])}}
    </div>
    <div class="form-group">
        {{Form::label('routes', 'Routes' )}}
        {{Form::text('routes', $record->routes, ['class' => 'form-control'])}}
    </div>
    <div class="form-group">
        {{Form::label('group', 'Group' )}}
        {{Form::text('group', $record->group, ['class' => 'form-control'])}}
    </div>

{{--    <div class="form-group">--}}
{{--        <label for="role_list">Roles</label>--}}
{{--        <div class="row">--}}
{{--            @foreach($role->all() as $p)--}}
{{--                <div class="col-md-3">--}}
{{--                    <div class="checkbox">--}}
{{--                        <label>--}}
{{--                            <input type="checkbox" id="role_list"  name="role_list[]" value={{$p->id}}--}}
{{--                                   @if($record->hasRole($p->name))--}}
{{--                                   checked--}}
{{--                                @endif--}}
{{--                            >--}}
{{--                            {{$p->name}}--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}
        @if(!empty($record) && $record->name == null)
            {{Form::submit('Add', ['class' => 'btn btn-primary'])}}
            {{Form::submit('Add More', ['class' => 'btn btn-info'])}}
        @else
            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Edit', ['class' => 'btn btn-info'])}}
        @endif
    {!! Form::close() !!}
@endsection
