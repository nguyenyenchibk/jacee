@extends('layouts.teacher')
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
        <form action="{{ route('teacher.markasread', $notification->id)}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm">
                <i class="material-icons">You just took charge of {{ $notification->data['course_name']}}</i>
            </button>
        </form>
        <span class="float-right text-muted text-sm">{{ $notification->created_at }}</span>
    </a>
    @endforeach
    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
</div>
@overwrite

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-2">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Teacher</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Teacher</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box border border-primary">
                        <div class="inner">
                            <h3>{{ $total_student }}</h3>

                            <p>Total Students</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box border border-warning">
                        <div class="inner">
                            <h3>{{ $total_course }}</h3>

                            <p>Total Courses</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>
            </div>
            <form class="mt-0" action="">
                <div class="form-group row">
                    <select class="form-select mx-2 p-2" id="inputGroupSelect04"
                        aria-label="Example select with button addon" type="search" name="course_id">
                        <option selected>Open this select course</option>
                        @foreach($courses as $course)
                        <option value="{{ $course->id }}" required>{{ $course->code }}-{{ $course->name }}</option>
                        @endforeach
                    </select>
                    <select class="form-select mr-2 p-2" aria-label=".form-select-lg example" type="search" name="time">
                        <option value="{{ $now }}" selected>{{ $now->format('Y-m') }}</option>
                    </select>
                    <button type="submit" class="btn btn-outline-primary mr-2">
                        {{ __('Search') }}
                    </button>
                    <a class="btn btn-outline-success" href="javascript:;" data-toggle="modal"
                        data-target="#myModal">Result</a>
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
                    backgroundColor: "#DFE9F1",
                    data: averages
                }]
            };

            window.onload = function()
            {
                var ctx = document.getElementById("canvas").getContext("2d");
                window.myBar = new Chart(ctx,
                {
                    type: 'bar',
                    data: barChartData,
                    options: {
                        elements: {
                            rectangle: {
                                borderWidth: 2,
                                borderColor: '#87AACA',
                                borderSkipped: 'bottom'
                            }
                        },
                        responsive: true,
                        title: {
                            display: true,
                            text: 'Monly Test Result'
                        }
                    }
                });
            };
    </script>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Result</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="#">
                        @csrf
                        <div class="form-group">
                            <label for="student_id">Enter Student</label>
                            <table class="table table-striped table-bordered table-hover datatable">
                                <thead>
                                    <tr>
                                        <th>#Test ID</th>
                                        <th>Test Name</th>
                                        <th>Student Email</th>
                                        <th>Average</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($student_test as $student_test)
                                    <tr>
                                        <td>{{ $student_test->test_id }}</td>
                                        <td>{{ $student_test->test_name }}</td>
                                        <td>{{ $student_test->student_email }}</td>
                                        <td>{{ $student_test->average }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                            <a href="{{ route('teacher.export') }}" class="btn btn-success">Export</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
