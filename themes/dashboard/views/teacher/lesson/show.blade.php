@extends('layouts.teacher')
@section('title','Dashboard')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Show Lesson</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">My Course</a></li>
                        <li class="breadcrumb-item"><a href="#">Show Course</a></li>
                        <li class="breadcrumb-item active">Show Lesson</li>
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
                                <h3 class="card-title">Lesson Information</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('teacher.lesson.show', $lesson->id) }}"
                                    class="mt-4">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name')
                                            }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ $lesson->name }}" required autocomplete="name" autofocus
                                                disabled>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="description" class="col-md-4 col-form-label text-md-right">{{
                                            __('Description') }}</label>

                                        <div class="col-md-6">
                                            <textarea id="description" name="description" class="form-control"
                                                style="height: 100px" disabled>{{ $lesson->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="mb-0 form-group row">
                                        <div class="col-md-6 offset-md-4">
                                            {{-- <a class="btn btn-outline-primary"
                                                href="{{ route('teacher.course.show') }}" role="button">Cancel</a> --}}
                                            <a class="btn btn-warning"
                                                href="{{ route('teacher.test.create', $lesson->id) }}"
                                                role="button">Create Test</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @endsection
