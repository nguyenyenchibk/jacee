@extends('layouts.app')
@section('title','Dashboard')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Teacher</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manage Teacher</li>
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
                                    <a href="{{ route('admin.teacher.create') }}" class="btn btn-primary btn-l">Add new</a>
                                    <a class="btn btn-success" href="javascript:;" data-toggle="modal"
                                        data-target="#myModal">Import</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered table-hover datatable">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teachers as $teacher )
                                        <tr>
                                            <td>{{ $teacher->id }}</td>
                                            <td>{{ $teacher->name }}</td>
                                            <td>{{ $teacher->email }}</td>
                                            @if($teacher->status === 1)
                                            <td>ACTIVE</td>
                                            @else
                                            <td>NON-ACTIVE</td>
                                            @endif
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-primary" href="{{ route('admin.teacher.edit', $teacher->id) }}">Edit</a>
                                                    <form id="delete-confirm" action="{{ route('admin.teacher.delete', $teacher->id )}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" form="delete-confirm" class="btn btn-danger">
                                                            {{ __('Delete') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
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
                    <h4 class="modal-title">Import Excel File</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.teacher.import') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-10">
                                <input type="file" name="file" class="form-control" />
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-success">Upload File...</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @endsection
