@extends('admin.dashboard')
@section('title')
    Profile
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile"  style="min-height: 310px">
                            <div class="text-center">
                                <img style="width: 150px; height: 150px" class="profile-user-img img-fluid img-circle"
                                     src="{{url('/')}}/Admin/img/mahmoud.jpg" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{auth()->user()->name}}</h3>
                            <p class="text-muted text-center">{{ auth()->user()->roles->pluck('name') }}</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#editprofile" data-toggle="tab">Edit Profile</a></li>
                                <li class="nav-item"><a class="nav-link" href="#changepassword" data-toggle="tab">Change Password</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                {{--              edit profile                  --}}
                                <div class="tab-pane active" id="editprofile">
                                     {!! Form::open(['class' => "form-horizontal",
                                         'action' => "HomeController@edit_profile", 'method' => 'POST'
                                         ]) !!}
                                         {{Form::hidden('_method', 'PUT')}}
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" class="form-control"
                                                       id="inputName" placeholder="Name"
                                                       value="{{auth()->user()->name}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email"
                                                       value="{{auth()->user()->email}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Image</label>
                                            <div class="col-sm-10">
                                                <input type="file" name="Image" class="form-control" id="inputName2">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                     {!! Form::close() !!}
                                </div>
                                <!-- /.tab-pane -->
                                {{--              change password                  --}}
                                <div class="tab-pane" id="changepassword">
                                        {!! Form::open(['class' => "form-horizontal",
                                         'action' => "Auth\ChangePasswordController@changepass", 'method' => 'POST'
                                         ]) !!}
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-4 col-form-label">Old Password</label>
                                            <div class="col-sm-8">
                                                <input type="password" name="old_password" class="form-control" id="inputName" placeholder="Old Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-4 col-form-label">New Password</label>
                                            <div class="col-sm-8">
                                                <input type="password" name="new_password" class="form-control" id="inputEmail" placeholder="New Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-4 col-form-label">Confirm Password</label>
                                            <div class="col-sm-8">
                                                <input type="password" name="confirm_password" class="form-control" id="inputName2" placeholder="Confirm Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-4 col-sm-8">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
