@inject('role', "Spatie\Permission\Models\Role")
@inject('permission', "Spatie\Permission\Models\Permission")
@extends('admin.dashboard')
@section('content')
    @section('title')
    @if(!empty($record) && $record->name == null)
{{--        @dd('create')--}}
        New User
        {!! Form::open(['method' => 'POST', 'action' => 'AdminController@store']) !!}
    @else
{{--        @dd('update')--}}
        Edit User
        {!! Form::open(['method' => 'POST', 'action' => ['AdminController@update', $record->id]]) !!}
    @endif
    @endsection
            <div class="form-group">
                {{Form::label('name', 'Name' )}}
                {{Form::text('name', $record->name, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('email', 'E_mail' )}}
                {{Form::text('email', $record->email, ['class' => 'form-control'])}}
            </div>
            <div class="form-group role">
                <label for="role_list">Roles</label><br>
                <a class="checkAllRole btn btn-sm btn-primary">checkAll</a>
                <a class="uncheckAllRole btn btn-sm btn-warning">uncheckAll</a>
                <div class="row">
                    @foreach($role->all() as $p)
                        <div class="col-md-3">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="role_list" value="{{$p->id}}" name="role_list[]"
                                           @if($record->hasRole($p->name))
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
            <div class="form-group permission">
    <label for="permission_list">Permissions</label><br>
    <a class="checkAllPermission btn btn-sm btn-primary">checkAll</a>
    <a class="uncheckAllPermission btn btn-sm btn-warning">uncheckAll</a>
    <div class="row">
        @foreach($permission->all() as $p)
            <div class="col-md-3">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" id="permission_list" value="{{$p->id}}" name="permission_list[]"
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

@push('script')
    <script>
        $('.checkAllPermission').click(function(){
            $('div.permission input:checkbox').each(function(){
                $(this).prop('checked',true);
            })
        });
        $('.uncheckAllPermission').click(function(){
            $('div.permission input:checkbox').each(function(){
                $(this).prop('checked',false);
            })
        });
        $('.checkAllRole').click(function(){
            $('div.role input:checkbox').each(function(){
                $(this).prop('checked',true);
            })
        });
        $('.uncheckAllRole').click(function(){
            $('div.role input:checkbox').each(function(){
                $(this).prop('checked',false);
            })
        });
    </script>
@endpush

@endsection
