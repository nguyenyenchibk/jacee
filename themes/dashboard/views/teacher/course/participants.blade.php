@extends('layouts.teacher')
@section('title','Dashboard')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Participants</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Course</a></li>
                        <li class="breadcrumb-item active">Manage Participants</li>
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
                                <h3 class="card-title">List</h3>
                                <div class="card-tools">
                                    <a href="{{ route('teacher.course.show', $course) }}" class="btn btn-light">Cancel</a>
                                    <a class="btn btn-warning" href="javascript:;" data-toggle="modal"
                                        data-target="#myModal">Add student</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($participants as $participant )
                                        <tr>
                                            <td>{{ $participant->student_id }}</td>
                                            <td>{{ $participant->name }}</td>
                                            <td>{{ $participant->email }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
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
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
