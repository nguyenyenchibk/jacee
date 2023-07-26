@extends('layouts.student')
@section('title','Dashboard')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">My Course</a></li>
                        <li class="breadcrumb-item"><a href="#">Show Lesson</a></li>
                        <li class="breadcrumb-item active">Test</li>
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
                                    <a href="{{ route('student.lesson.show', [$course, $lesson])}}" class="btn btn-light">Cancel</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form class="mt-0">
                                    <div class="form-group row">
                                        <label for="name" class="col-md-1 col-form-label">Max Score:</label>
                                        <div class="col-sm-2">
                                                <p class="form-control-plaintext" id="score">{{ $test->max_score }}</p>
                                        </div>
                                    </div>
                                </form>
                                <form method="POST" action="{{ route('student.test.store', [$course, $lesson, $test])}}">
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
                                            <button type="submit" class="btn btn-primary show_confirm"
                                            data-toggle="tooltip" title='Submit'>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
        <script type="text/javascript">
            $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to submit this test?`,
              text: "If you submit this, it will be gone to result.",
              icon: "warning",
              buttons: true,
              primayMode: true,
          })
          .then((willSubmit) => {
            if (willSubmit) {
              form.submit();
            }
          });
        });
        </script>
    @endsection
