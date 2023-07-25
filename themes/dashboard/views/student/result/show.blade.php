@extends('layouts.student')
@section('title','Dashboard')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Show Result</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">My Course</a></li>
                        <li class="breadcrumb-item"><a href="#">Show Lesson</a></li>
                        <li class="breadcrumb-item active">Show Result</li>
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
                                <h3 class="card-title">Result</h3>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-light">Cancel</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form class="mt-0">
                                    <div class="form-group row">
                                        <label for="name" class="col-md-1 col-form-label">Score:</label>
                                        <div class="col-sm-2">
                                            @foreach($student_test as $key => $value)
                                                <p class="form-control-plaintext" id="name">{{ $value }} / {{ $test->max_score }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </form>
                                <form>
                                    @foreach($questions as $question)
                                    <div class="card @if(!$loop->last)mb-3 @endif">
                                        <div class="card-header">{{ $question->question }}</div>

                                        <div class="card-body">
                                            <input type="hidden" name="questions[{{ $question->id }}]" value="">
                                            @foreach($question->answers as $answer)
                                            <div class="form-check">
                                                @if($results->where('answer', $answer->id)->where('is_correct', 1)->count() > 0)
                                                <input class="form-check-input" type="radio"
                                                    name="questions[{{ $question->id }}]" id="answer-{{ $answer->id }}"
                                                    value="{{ $answer->id }}" checked disabled>
                                                <div class="form-check-label bg-success text-white bg-opacity-75" for="answer-{{ $answer->id }}">
                                                    {{ $answer->answer }}
                                                </div>
                                                @elseif($results->where('answer', $answer->id)->where('is_correct', 0)->count() > 0)
                                                <input class="form-check-input " type="radio"
                                                    name="questions[{{ $question->id }}]" id="answer-{{ $answer->id }}"
                                                    value="{{ $answer->id }}" checked disabled>
                                                <div class="form-check-label bg-danger text-white bg-opacity-75" for="answer-{{ $answer->id }}">
                                                    {{ $answer->answer }}
                                                </div>
                                                @else
                                                <input class="form-check-input" type="radio"
                                                    name="questions[{{ $question->id }}]" id="answer-{{ $answer->id }}"
                                                    value="{{ $answer->id }}" disabled>
                                                <div class="form-check-label" for="answer-{{ $answer->id }}">
                                                    {{ $answer->answer }}
                                                </div>
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endforeach
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @endsection
