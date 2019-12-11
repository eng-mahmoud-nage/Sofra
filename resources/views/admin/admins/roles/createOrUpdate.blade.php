@inject('permission', "Spatie\Permission\Models\Permission")
@extends('admin.dashboard')
@section('content')
    @section('title')
    @if(!empty($record) && $record->name == null)
{{--        @dd('create')--}}
        New Role
        {!! Form::open(['method' => 'POST', 'action' => 'Role\RoleController@store']) !!}
    @else
{{--        @dd('update')--}}
        Edit Role
        {!! Form::open(['method' => 'POST', 'action' => ['Role\RoleController@update', $record->id]]) !!}
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
        <label for="permission_list">Permissions</label>
        <div class="row">
            @foreach($permission->all() as $p)
                <div class="col-md-3">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="permission_list"  name="permission_list[]" value={{$p->id}}
                                   @if($record->hasPermissionTo($p->name))
                                   checked
                                @endif
                            >
                            {{$p->name}}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
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
