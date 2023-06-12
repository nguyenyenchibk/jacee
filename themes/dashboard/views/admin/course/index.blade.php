@extends('layouts.app')
@section('title','Dashboard')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Course</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manage Course</li>
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
                                    <a href="{{ route('admin.course.create') }}" class="btn btn-info btn-l"
                                        href="">Add
                                        new</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row row-cols-2">
                                    @foreach ($courses as $course)
                                    <div class="card" style="width: 18rem;height:200px">
                                        <div class="card-header">#{{ $course->id}}</div>
                                        <div class="card-body  overflow-auto">
                                            <h5 class="card-title">{{ $course->full_name }}</h5>
                                            <p class="card-text">{{ $course->description }}</p>
                                        </div>
                                        <div class="card-footer">
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <button type="button" class="btn btn-warning"><a href="{{ route('admin.course.edit', $course->id) }}">Edit</a></button>
                                                <form id="delete-confirm" action="{{ route('admin.course.delete', $course->id )}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" form="delete-confirm" class="btn btn-danger">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>
                                              </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
</div>
    @endsection