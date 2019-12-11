@inject('cities', 'App\General\City')
@extends('admin.dashboard')
@section('content')
    @section('title')
{{--        @dd(empty($record), $record->name)--}}
    @if(!empty($record) && $record->name == null)
{{--        @dd('create')--}}
        New District
        {!! Form::open(['method' => 'POST', 'action' => 'DistrictController@store']) !!}
    @else
{{--        @dd('update')--}}
        Edit District
        {!! Form::open(['method' => 'POST', 'action' => ['DistrictController@update', $record->id]]) !!}
    @endif
    @endsection
        <div class="form-group">
            {{Form::label('name', 'Name' )}}
            {{Form::text('name', $record->name, ['class' => 'form-control'])}}
        </div>
        <div class="form-group category">
            <label for="governorate_id">City</label><br>
            <div class="row">
                @foreach($cities->all() as $p)
                    <div class="col-md-3">
                        <div class="custom-radio">
                            <label>
                                <input type="radio" id="city_id" value="{{$p->id}}" name="city_id"
                                       @if($record->city_id == $p->id)
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
