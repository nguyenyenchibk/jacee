@extends('layouts.student')
@section('title','Dashboard')
@section('notifications')
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        @if($notifications->count() > 0)
        <span class="badge badge-danger navbar-badge">{{ $notifications->count() }}</span>
        @else
        <span class="badge badge-warning navbar-badge">0</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        @foreach($notifications as $notification)
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i>You just added to the course {{ $notification->data['course_name']}}
            <span class="float-right text-muted text-sm">{{ $notification->created_at }}</span>
        </a>
        @endforeach
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer" id="mark-all">See All Notifications</a>
    </div>
@overwrite
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Student</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Student</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box border border-info">
                        <div class="inner">
                            <h3>1</h3>

                            <p>Courses</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @endsection
