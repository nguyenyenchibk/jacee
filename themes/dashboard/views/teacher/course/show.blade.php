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
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('teacher.course.show', $course->id) }}"
                                    class="mt-4">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name')
                                            }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ $course->name }}" required autocomplete="name" autofocus
                                                disabled>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Code')
                                            }}</label>

                                        <div class="col-md-6">
                                            <input id="code" type="code"
                                                class="form-control @error('code') is-invalid @enderror" name="code"
                                                value="{{ $course->code }}" required autocomplete="code" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="started_at" class="col-md-4 col-form-label text-md-right">{{
                                            __('Start At') }}</label>

                                        <div class="col-md-6">
                                            <input id="started_at" type="date" format="Y-m-d"
                                                class="form-control @error('started_at') is-invalid @enderror"
                                                name="started_at" value="{{ $course->started_at }}" required
                                                autocomplete="started_at" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="ended_at" class="col-md-4 col-form-label text-md-right">{{ __('End
                                            At') }}</label>

                                        <div class="col-md-6">
                                            <input id="ended_at" type="date" format="Y-m-d"
                                                class="form-control @error('ended_at') is-invalid @enderror"
                                                name="ended_at" value="{{ $course->ended_at }}" required
                                                autocomplete="ended_at" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="description" class="col-md-4 col-form-label text-md-right">{{
                                            __('Description') }}</label>

                                        <div class="col-md-6">
                                            <textarea id="description" name="description" class="form-control"
                                                style="height: 100px" disabled>{{ $course->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="mb-0 form-group row">
                                        <div class="col-md-6 offset-md-4">
                                            <a class="btn btn-outline-primary"
                                                href="{{ route('teacher.course.index') }}" role="button">Cancel</a>
                                            <a class="btn btn-warning"
                                                href="{{ route('teacher.lesson.create', $course->id) }}"
                                                role="button">Create Lesson</a>
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
                                                <a href="{{ route('teacher.lesson.show', $lesson->id) }}"
                                                    role="button" class="btn btn-primary">Go</a>
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
