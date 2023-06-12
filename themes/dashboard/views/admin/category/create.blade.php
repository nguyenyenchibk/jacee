@extends('layouts.app')
@section('title','Dashboard')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#" >Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}" >Category</a></li>
                        <li class="breadcrumb-item active">Create Category</li>
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
                                <h3 class="card-title">Category Information</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.category.store') }}" class="mt-4">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                            <input id="code" type="code" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="code">

                                            @error('code')
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
                                                <option value="1" selected>Active</option>
                                                <option value="0">Non-active</option>
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
                                            <textarea id="description" name="description" class="form-control" placeholder="Leave description here" style="height: 100px"></textarea>
                                        </div>
                                    </div>

                                    <div class="mb-0 form-group row">
                                        <div class="col-md-6 offset-md-4">
                                            <a class="btn btn-outline-primary" href="{{ route('admin.category.index') }}" role="button">Cancel</a>

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
