@inject('posts', "App\Post")
@inject('admins', "App\User")
@inject('donations', "App\DonationRequest")
@inject('contacts', "App\Contact")
@extends('admin.dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box // # of clients-->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$admins->count()}}</h3>

                    <p>Users</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{{url(route('admin.index'))}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box # of posts-->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$posts->count()}}</h3>

                    <p>Posts</p>
                </div>
                <div class="icon">
                    <i class="fa fa-book-open"></i>
                </div>
                <a href="{{url(route('post.index'))}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box // donations -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$donations->count()}}</h3>

                    <p>Donations</p>
                </div>
                <div class="icon">
                    <i class="fa fa-check-circle"></i>
                </div>
                <a href="{{url(route('donation.index'))}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box  contacts -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$contacts->count()}}</h3>

                    <p>Message</p>
                </div>
                <div class="icon">
                    <i class="fa fa-envelope-open-text"></i>
                </div>
                <a href="{{url(route('contact.index'))}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
@endsection
