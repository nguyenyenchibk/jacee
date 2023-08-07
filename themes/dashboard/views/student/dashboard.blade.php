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
            <form action="{{ route('student.markasread', $notification->id)}}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="material-icons">You just added to course {{ $notification->data['course_name']}}</i>
                </button>
            </form>
            <span class="float-right text-muted text-sm">{{ $notification->created_at }}</span>
        </a>
        @endforeach
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer" id="mark-all">See All Notifications</a>
    </div>
@overwrite
@section('content')

<div class="content-wrapper p-2">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Student</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Student</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box border border-primary">
                        <div class="inner">
                            <h3>{{ $courses->count() }}</h3>

                            <p>Courses</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
            </div>
            <form class="mt-0" action="">
                <div class="form-group row">
                    <div class="input-group mb-3 col-sm-8">
                        <select class="form-select col-sm-5" id="inputGroupSelect02" type="search" name="course_id">
                            <option selected>Open this select course</option>
                            @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->code }} - {{ $course->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-outline-primary">
                            {{ __('Search') }}
                        </button>
                      </div>
                </div>
            </form>
        </div>
        <canvas id="canvas" height="200" width="500"></canvas>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
        <script>
            var labels = <?php echo $labels; ?>;
            var averages = <?php echo $averages; ?>;
            var barChartData =
            {
                labels: labels,
                datasets: [{
                    label: 'Point',
                    backgroundColor: "transparent",
                    borderColor: "#87AACA",
                    data: averages
                }]
            };

            window.onload = function()
            {
                var ctx = document.getElementById("canvas").getContext("2d");
                window.myBar = new Chart(ctx,
                {
                    type: 'line',
                    data: barChartData,
                    options: {
                        elements: {
                        },
                        responsive: true,
                        title: {
                            display: true,
                            text: 'Test Result'
                        }
                    }
                });
            };
        </script>
        @endsection

