@extends('layouts.student')
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
                                <h3 class="card-title">Test</h3>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-light">Cancel</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('student.test.store', $test)}}">
                                    @csrf
                                    @foreach($questions as $question)
                                    <div class="card @if(!$loop->last)mb-3 @endif">
                                        <div class="card-header">{{ $question->question }}</div>

                                        <div class="card-body">
                                            <input type="hidden" name="questions[{{ $question->id }}]" value="">
                                            @foreach($question->answers as $answer)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="questions[{{ $question->id }}]" id="answer-{{ $answer->id }}"
                                                    value="{{ $answer->id }}">
                                                <label class="form-check-label" for="answer-{{ $answer->id }}">
                                                    {{ $answer->answer }}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endforeach

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary">
                                                Submit
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
