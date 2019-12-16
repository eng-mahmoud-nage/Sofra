@extends('admin.dashboard')
@section('title')
    Categories
@endsection
@section('content')

    @if(count($records)<1)
        <div class="alert alert-warning">
            whoops! : You don`t have Categories.
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <a class="btn btn-outline-primary" style="width: 100px;" href="{{url(route('category.create'))}}">
              <span class="float-md-left">
                  <i class="fa fa-plus"></i>
              </span>New
            </a>
        </div>
        <!-- /.card-header -->
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
                                    # of Restaurant
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 92px;">
                                    Edit
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
                                            <td>{{$record->restaurants->count()}}</td>
                                            <td>
                                                <a class="btn btn-primary btn-group-vertical" style="width: 90%; margin-left: 5%" href="{{url(route('category.edit', $record->id))}}">
                                                    <i class="fa fa-edit" ></i>
                                                </a>
                                            </td>
                                            <td>
                                                {!! Form::open(['method' => 'POST', 'action' => ['CategoryController@destroy', $record->id]]) !!}
                                                    {{Form::hidden('_method', 'DELETE')}}
                                                    <button class="btn btn-warning btn-group-vertical" style="width: 90%; margin-left: 5%">
                                                        <i class="fa fa-trash-alt" ></i>
                                                    </button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @else
                                        <tr role="row" class="even">
                                            <td class="sorting_1">{{$loop->iteration}}</td>
                                            <td>{{$record->name}}</td>
                                            <td>{{$record->restaurants->count()}}</td>
                                            <td>
                                                <a class="btn btn-primary btn-group-vertical" style="width: 90%; margin-left: 5%" href="{{url(route('category.edit', $record->id))}}">
                                                    <i class="fa fa-edit" ></i>
                                                </a>
                                            </td>
                                            <td>
                                                {!! Form::open(['method' => 'POST', 'action' => ['CategoryController@destroy', $record->id]]) !!}
                                                    {{Form::hidden('_method', 'DELETE')}}
                                                    <button class="btn btn-warning btn-group-vertical" style="width: 90%; margin-left: 5%">
                                                        <i class="fa fa-trash-alt" ></i>
                                                    </button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr><th rowspan="1" colspan="1">Rendering engine</th><th rowspan="1" colspan="1">Browser</th><th rowspan="1" colspan="1">Platform(s)</th><th rowspan="1" colspan="1">Engine version</th><th rowspan="1" colspan="1">CSS grade</th></tr>
                            </tfoot>
                        </table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
