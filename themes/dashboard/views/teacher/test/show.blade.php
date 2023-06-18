@extends('layouts.teacher')
@section('title','Dashboard')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Show Test</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">My Course</a></li>
                        <li class="breadcrumb-item"><a href="#">Show Lesson</a></li>
                        <li class="breadcrumb-item active">Show Test</li>
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
                                <h3 class="card-title">Test Information</h3>
                            </div>
                            <div class="card-body">
                                <form class="mt-4">
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name')
                                            }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ $test->name }}" required autocomplete="name" autofocus
                                                disabled>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="description" class="col-md-4 col-form-label text-md-right">{{
                                            __('Description') }}</label>

                                        <div class="col-md-6">
                                            <textarea id="description" name="description" class="form-control"
                                                style="height: 100px" disabled>{{ $test->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="mb-0 form-group row">
                                        <div class="col-md-6 offset-md-4">
                                            <a class="btn btn-info btn-sm" href="javascript:;" data-toggle="modal"
                                                data-target="#myModal">Add new</a>
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
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add new Question</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('teacher.question.store', $test->id) }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="content">Enter Question</label>
                                    <input type="text" required="required" name="content" placeholder="Enter Question"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label for="status">{{ __('Is question open?') }}</label>
                                <div class="col-md-12">
                                    <select class="form-control" required="required" id="status" name="status">
                                        <option value="1" selected>Open</option>
                                        <option value="0">Non-open</option>
                                    </select>

                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Enter Answer 1</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input type="hidden" value="0" name="answers[1][is_correct]">
                                            <input type="checkbox" value="1" name="answers[1][is_correct]">
                                        </div>
                                        <input name="answers[1][content]" value="{{ old('answers.1.content') }}" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Enter Answer 2</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input type="hidden" value="0" name="answers[2][is_correct]">
                                            <input type="checkbox" value="1" name="answers[2][is_correct]">
                                        </div>
                                        <input name="answers[2][content]" value="{{ old('answers.2.content') }}" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Enter Answer 3</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input type="hidden" value="0" name="answers[3][is_correct]">
                                            <input type="checkbox" value="1" name="answers[3][is_correct]">
                                        </div>
                                        <input name="answers[3][content]" value="{{ old('answers.3.content') }}" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Enter Answer 4</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input type="hidden" value="0" name="answers[4][is_correct]">
                                            <input type="checkbox" value="1" name="answers[4][is_correct]">
                                        </div>
                                        <input name="answers[4][content]" value="{{ old('answers.4.content') }}" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="content">Enter Score</label>
                                    <input type="integer" required="required" name="score" placeholder="Enter Score"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>


        @endsection
