@extends('layouts.app')
@section('title','Dashboard')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Course</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#" >Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.course.index') }}" >Course</a></li>
                        <li class="breadcrumb-item active">Edit Course</li>
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
                                <form method="POST" action="{{ route('admin.course.update', $course->id) }}" class="mt-4">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $course->name }}" required autocomplete="name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Code') }}</label>

                                        <div class="col-md-6">
                                            <input id="code" type="code" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ $course->code }}" required autocomplete="code">

                                            @error('code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="started_at" class="col-md-4 col-form-label text-md-right">{{ __('Start At') }}</label>

                                        <div class="col-md-6">
                                            <input id="started_at" type="date" format="Y-m-d" class="form-control @error('started_at') is-invalid @enderror" name="started_at" value="{{ $course->started_at }}" required autocomplete="started_at">

                                            @error('started_at')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="ended_at" class="col-md-4 col-form-label text-md-right">{{ __('End At') }}</label>

                                        <div class="col-md-6">
                                            <input id="ended_at" type="date" format="Y-m-d" class="form-control @error('ended_at') is-invalid @enderror" name="ended_at" value="{{ $course->ended_at }}" required autocomplete="ended_at">

                                            @error('ended_at')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="teacher_id" class="col-md-4 col-form-label text-md-right">{{ __('Teacher') }}</label>

                                        <div class="col-md-6">
                                            <select class="form-control" required="required" id="teacher_id" name="teacher_id">
                                                <option value="">Select</option>
                                                @foreach ($teachers as $teacher)
                                                <option value="{{ $teacher->id }}" @if($course->teacher_id == $teacher->id) selected @endif>{{ $teacher->select_name }}</option>
                                                @endforeach
                                            </select>

                                            @error('teacher_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="category_id" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                                        <div class="col-md-6">
                                            <select class="form-control" required="required" id="category_id" name="category_id">
                                                <option value="">Select</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @if($course->category_id == $category->id) selected @endif>{{ $category->full_name }}</option>
                                                @endforeach
                                            </select>

                                            @error('category_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Is account active ?') }}</label>

                                        <div class="col-md-6">
                                            <select class="form-control" required="required" id="status" name="status">
                                                <option value="1" @if($category->status === 1) selected @endif>Active</option>
                                                <option value="0"  @if($category->status === 0) selected @endif>Non-active</option>
                                            </select>

                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                        <div class="col-md-6">
                                            <textarea id="description" name="description" class="form-control" placeholder="Leave description here" style="height: 100px">{{ $course->description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="mb-0 form-group row">
                                        <div class="col-md-6 offset-md-4">
                                            <a class="btn btn-outline-primary" href="{{ route('admin.course.index') }}" role="button">Cancel</a>

                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Create') }}
                                            </button>
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
