@extends('layouts.app')
@section('title','Dashboard')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Student</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Manage Student</li>
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
                                    <a href="{{ route('admin.student.create') }}" class="btn btn-primary btn-l">Add new</a>
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
                                        @foreach ($students as $student )
                                        <tr>
                                            <td>{{ $student->id }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->email }}</td>
                                            @if($student->status === 1)
                                            <td>ACTIVE</td>
                                            @else
                                            <td>NON-ACTIVE</td>
                                            @endif
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-primary" href="{{ route('admin.student.edit', $student->id) }}">Edit</a>
                                                    <form id="delete-confirm" action="{{ route('admin.student.delete', $student->id )}}" method="POST">
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
    <div class="modal fade" id="deleteModel" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <label for="delete" class="form-label">Are you sure delete this account ?</label>
                    <div class="mb-0 form-group row">
                        <div class="col-md-6 offset-md-4">
                            <a class="btn btn-outline-primary" href="{{ route('admin.student.index') }}"
                                role="button">Cancel</a>
                            <button type="submit" form="confirm" class="btn btn-danger">
                                {{ __('Delete') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endsection
