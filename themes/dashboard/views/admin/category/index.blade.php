@extends('layouts.app')
@section('title','Dashboard')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manage Category</li>
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
                                    <a href="{{ route('admin.category.create') }}" class="btn btn-primary btn-l">Add new</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row row-cols-2">
                                    @foreach ($categories as $category)
                                    <div class="col">
                                        <div class="p-1">
                                            <div class="card" style="height:200px">
                                                <div class="card-header">#{{ $category->id}} {{ $category->name}}</div>
                                                <div class="card-body  overflow-auto">
                                                    <h5 class="card-title">{{ $category->full_name }}</h5>
                                                    <p class="card-text">{{ $category->description }}</p>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                        <a class="btn btn-outline-primary" href="{{ route('admin.category.edit', $category->id) }}" role="button">Edit</a>
                                                    </div>
                                                </div>
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
