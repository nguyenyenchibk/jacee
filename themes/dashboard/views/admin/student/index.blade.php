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
                                    <a href="{{ route('admin.student.create') }}" class="btn btn-primary btn-l">Add
                                        new</a>
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
                                                    <a class="btn btn-primary"
                                                        href="{{ route('admin.student.edit', $student->id) }}">Edit</a>
                                                    <form action="{{ route('admin.student.delete', $student->id )}}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger show_confirm" data-toggle="tooltip" title='Delete'>
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
                    <form action="{{ route('admin.student.import') }}" method="POST" enctype="multipart/form-data">
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
        <script type="text/javascript">
            $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this record?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
        });
        </script>
        @endsection
