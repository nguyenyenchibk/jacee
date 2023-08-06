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
                                <div class="card-tools">
                                    <a href="#" class="btn btn-light">Cancel</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form class="mt-0">
                                    <div class="form-group row">
                                        <label for="name" class="col-md-1 col-form-label">Name:</label>
                                        <div class="col-sm-2">
                                            <p class="form-control-plaintext" id="name">{{ $test->name }}</p>
                                        </div>
                                        <label for="validate_date" class="col-form-label">Deadline:</label>
                                        <div class="col-sm-2">
                                            <p class="form-control-plaintext" id="validate_date">{{ $test->validate_date
                                                }}</p>
                                        </div>
                                        <label for="time" class="col-form-label">Interval:</label>
                                        <div class="col-sm-2">
                                            <p class="form-control-plaintext" id="time">{{ $test->time }}</p>
                                        </div>
                                        <label for="time" class="col-form-label">Max Score:</label>
                                        <div class="col-sm-2">
                                            <p class="form-control-plaintext" id="time">{{ $test->max_score }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-md-1 col-form-label">Description:</label>
                                        <div class="col-md-6">
                                            <p class="form-control-plaintext" id="description">{{ $test->description }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <a class="btn btn-info btn-sm" href="javascript:;" data-toggle="modal"
                                            data-target="#myModal">Add question</a>
                                    </div>
                                </form>
                                @foreach($questions as $question)
                                <div class="card @if(!$loop->last)mb-3 @endif">
                                    <div class="card-header">
                                        {!! $question->question !!}
                                        @php
                                        $data = [];
                                        $files = Storage::disk('s3')->files('teachers/tests/'.$test->id.'/questions'.'/'.$question->id);
                                        foreach ($files as $file) {
                                            $data[] = [
                                                'name' => basename($file),
                                                'downloadUrl' => $file,
                                            ];
                                        }
                                        @endphp
                                        @foreach($data as $data)
                                        <audio controls>
                                            <source src="{{ Storage::disk('s3')->url($data['downloadUrl']) }}" type="audio/mpeg">
                                            </audio>
                                        @endforeach
                                    </div>

                                    <div class="card-body">
                                        @foreach($question->answers as $answer)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio"
                                                name="questions[{{ $question->id }}]" id="answer-{{ $answer->id }}"
                                                value="{{ $answer->id }}" disabled>
                                            <label class="form-check-label" for="answer-{{ $answer->id }}">
                                                {{ $answer->answer }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg" style="overflow-y: initial">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add new Question</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="height:800px; overflow-y:auto">
                    <form method="POST" action="{{ route('teacher.question.store', $test->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="question">Enter Question</label>
                                    <textarea type="text" required="required" name="question"
                                        placeholder="Enter Question" class="ckeditor form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="question">File</label>
                                    <div class="col-md-12">
                                        <input type="file" name="file" class="form-control" />
                                    </div>
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
                                        <input name="answers[1][answer]" value="{{ old('answers.1.answer') }}"
                                            type="text" class="form-control">
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
                                        <input name="answers[2][answer]" value="{{ old('answers.2.answer') }}"
                                            type="text" class="form-control">
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
                                        <input name="answers[3][answer]" value="{{ old('answers.3.answer') }}"
                                            type="text" class="form-control">
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
                                        <input name="answers[4][answer]" value="{{ old('answers.4.answer') }}"
                                            type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="score">Enter Score</label>
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
        <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
        </script>
        @endsection
