@extends('layouts.student')
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
                        <li class="breadcrumb-item"><a href="{{ route('student.course.index') }}">My Course</a></li>
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
                                    <a href="{{ route('student.course.index') }}" class="btn btn-light">Cancel</a>
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
                                        <a href="{{ route('student.lesson.show', [$course, $lesson])}}"
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
    @endsection
