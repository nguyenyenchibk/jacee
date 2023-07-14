@extends('layouts.teacher')
@section('title','Dashboard')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Show Course</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('teacher.course.index') }}">My Course</a></li>
                        <li class="breadcrumb-item active">Show Course</li>
                    </ol>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Course Information</h3>
                                <div class="card-tools">
                                    <a href="{{ route('teacher.course.index') }}" class="btn btn-light">Cancel</a>
                                    <a href="{{ route('teacher.lesson.create', $course->id) }}"
                                        class="btn btn-primary">Add Lesson</a>
                                    <a class="btn btn-warning" href="javascript:;" data-toggle="modal"
                                        data-target="#myModal">Add student</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form class="mt-0">
                                    <div class="form-group row">
                                        <label for="name" class="col-md-1 col-form-label">Name:</label>
                                        <div class="col-sm-2">
                                            <p class="form-control-plaintext" id="name">{{ $course->full_name }}</p>
                                        </div>
                                        <label for="period" class="col-form-label">Period:</label>
                                        <div class="col-sm-2">
                                            <p class="form-control-plaintext" id="period">{{ $course->period }}</p>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="description" class="col-md-1 col-form-label">Description:</label>
                                        <div class="col-md-6">
                                            <p class="form-control-plaintext" id="description">{{ $course->description
                                                }}</p>
                                        </div>
                                    </div>
                                </form>
                                @foreach ($lessons as $lesson)
                                <div class="card">
                                    <div class="card-header">
                                        #{{ $lesson->id}}
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $lesson->name }}</h5>
                                        <p class="card-text">{{ $lesson->description }}</p>
                                        <a href="{{ route('teacher.lesson.show', [$course, $lesson]) }}"
                                            class="btn btn-outline-primary">Go</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Student</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('teacher.course.storeStudents', $course->id) }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="student_id">Enter Student</label>
                                    <table class="table table-striped table-bordered table-hover datatable">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>#ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($students as $student)
                                            @php
                                                $exist = DB::table('course_student')->where('student_id', $student->id)->where('course_id', $course->id)->first();
                                            @endphp
                                            <tr>
                                                @if($exist)
                                                    <td><input type="checkbox" value="{{ $student->id }}" name="student_id[{{ $student->id }}]" checked></td>
                                                @else
                                                <td><input type="checkbox" value="{{ $student->id }}" name="student_id[{{ $student->id }}]"></td>
                                                @endif
                                                <td>{{ $student->id }}</td>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->email }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-warning">
                                        {{ __('Add') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
