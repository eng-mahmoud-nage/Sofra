@extends('admin.dashboard')
@section('title')
    Clients
@endsection
@section('content')
    @if(!empty($records))
    <div class="card">
        <div class="card-header">
        </div><!-- /.card-header -->
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">

                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 156px;">
                                    #
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 203px;">
                                    Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 179px;">
                                    E mail
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 92px;">
                                    Status
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 92px;">
                                    Remove
                                </th>
                            </tr>

                            </thead>
                            <tbody>
                                @foreach($records as $record)
                                    @if($loop->odd)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{$loop->iteration}}</td>
                                            <td>{{$record->name}}</td>
                                            <td>
                                                {{$record->email}}
                                            </td>
                                            <td>
                                                {!! Form::open(['method' => 'POST', 'action' => ['ClientController@update', $record->id]]) !!}
                                                {{Form::hidden('_method', 'PUT')}}
                                                <button class="btn btn-danger " style="width: 90%; margin-left: 5%">
                                                    {{Form::checkbox('active', true, $record->active?true:false)}}
                                                    <i class="fa fa-arrow-circle-left"></i>
                                                </button>
                                                {!! Form::close() !!}
                                            </td>
                                            <td>
                                                {!! Form::open(['method' => 'POST', 'action' => ['ClientController@destroy', $record->id]]) !!}
                                                    {{Form::hidden('_method', 'DELETE')}}
                                                    <button class="btn btn-danger btn-group-vertical" style="width: 90%; margin-left: 5%">
                                                        <i class="fa fa-trash-alt" ></i>
                                                    </button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @else
                                        <tr role="row" class="even">
                                            <td class="sorting_1">{{$loop->iteration}}</td>
                                            <td>{{$record->name}}</td>
                                            <td>
                                                {{$record->email}}
                                            </td>
                                            <td>
                                                {!! Form::open(['method' => 'POST', 'action' => ['ClientController@update', $record->id]]) !!}
                                                {{Form::hidden('_method', 'PUT')}}
                                                <button class="btn btn-danger " style="width: 90%; margin-left: 5%">
                                                    {{Form::checkbox('active', true, $record->active?true:false)}}
                                                    <i class="fa fa-arrow-circle-left"></i>
                                                </button>
                                                {!! Form::close() !!}
                                            </td>
                                            <td>
                                                {!! Form::open(['method' => 'POST', 'action' => ['ClientController@destroy', $record->id]]) !!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                <button class="btn btn-danger btn-group-vertical" style="width: 90%; margin-left: 5%">
                                                    <i class="fa fa-trash-alt" ></i>
                                                </button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
        </div>

        <!-- /.card-body -->
    </div>

@else
    <div class="alert alert-danger">
        whoops! : You don`t have Permission to access this page.
    </div>
    @endif
@endsection
