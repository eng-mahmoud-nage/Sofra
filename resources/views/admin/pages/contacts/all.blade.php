@extends('admin.dashboard')
@section('title')
    Message
@endsection
@section('content')

    @if(count($records)<1)
        <div class="alert alert-warning">
            whoops! : You don`t have users.
        </div>
    @endif

    <div class="card">        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                @foreach($records as $record)
                <div class="col-md-4">
                    <div class="card bg-gradient-olive">
                        <div class="card-header" style="border-bottom: 1px solid #000">
                            <h3 class="card-title">Message {{$loop->iteration}}</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                {!! Form::open(['method' => 'POST', 'action' => ['ContactController@destroy', $record->id]]) !!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    <button class="btn btn-tool">
                                        <i class="fa fa-times" ></i>
                                    </button>
                                {!! Form::close() !!}
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            Name:
                            <label style="box-shadow: -2px -3px 3px rgba(0,0,0,0.1) inset; width:100%; text-align: center">
                            {{$record->name}}
                            </label><br>
                            E_mail:
                            <label style="box-shadow: -2px -3px 3px rgba(0,0,0,0.1) inset; width: 100%; text-align: center">
                            {{$record->e_mail}}
                            </label><br>
                            Phone:
                            <label style="box-shadow: -2px -3px 3px rgba(0,0,0,0.1) inset; width: 100%; text-align: center">
                            {{$record->phone}}
                            </label><br>
                            Subject:
                            <label style="box-shadow: -2px -3px 3px rgba(0,0,0,0.1) inset; width: 100%; text-align: center">
                            {{$record->subject}}
                            </label>
                        </div>
                        <div class="card-body">
                            Message: <br>
                            <textarea readonly rows="5" cols="31"
                                      class="bg-transparent" style="cursor: default; border-radius: 10%; border-color: transparent">
                                {{$record->message}}
                            </textarea>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            Send Message
                        </button>
                        </div></div>
                        <div class="card-body">
                            <textarea  rows="2" cols="31"
                                      style="cursor: text; border-radius: 10%; border-color: rgba(0,0,0,0.1)">
                            </textarea>
                        </div>
                    </div>
                </div>

                    @endforeach
            </div>
        </div>
        <!-- /.card-body -->
    </div>


@endsection
