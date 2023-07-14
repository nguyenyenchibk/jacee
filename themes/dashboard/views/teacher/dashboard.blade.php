@extends('layouts.teacher')
@section('title','Dashboard')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
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
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box border border-info">
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
            <!-- /.content -->
            <form action="">
                <div class="row">
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" type="search" name="course_id">
                        <option selected>Select Course</option>
                        @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->code }}</option>
                        @endforeach
                    </select>
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" type="search" name="time">
                        <option selected>Select Time</option>
                        <option value="{{ $now }}">{{ $now->format('Y-m') }}</option>
                        <option value="{{ $lastMonth }}">{{ $lastMonth->format('Y-m') }}</option>
                        <option value="{{ $last2Month }}">{{ $last2Month->format('Y-m') }}</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">
                    {{ __('Search') }}
                </button>
            </form>
        </div>
        <!-- /.content-wrapper -->
        <canvas id="canvas" height="280" width="600"></canvas>
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
                            text: 'Yearly User Joined'
                        }
                    }
                });
            };
        </script>
        @endsection
