@extends('layouts.student')
@section('title','Dashboard')
@section('content')

<div class="content-wrapper p-2">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Show Lesson</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">My Course</a></li>
                        <li class="breadcrumb-item"><a href="#">Show Course</a></li>
                        <li class="breadcrumb-item active">Show Lesson</li>
                    </ol>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Lesson Information</h3>
                                <div class="card-tools">
                                    <a href="{{ route('student.course.show', [$course, $lesson]) }}"
                                        class="btn btn-light">Cancel</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form class="mt-0">
                                    <div class="form-group row">
                                        <label for="name" class="col-md-1 col-form-label">Name:</label>
                                        <div class="col-sm-2">
                                            <p class="form-control-plaintext" id="name">{{ $lesson->name }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-md-1 col-form-label">Description:</label>
                                        <div class="col-md-6">
                                            <p class="form-control-plaintext" id="description">{{ $lesson->description }}</p>
                                        </div>
                                    </div>
                                </form>
                                @foreach ($files as $file)
                                <div class="card" style="width: 36rem;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <a href="{{ Storage::disk('s3')->url($file['downloadUrl']) }}">{{
                                                    $file['name'] }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @foreach($videos as $video)
                                {!! $video->url !!}
                                @endforeach
                                @foreach ($tests as $test)
                                <div class="card mt-3">
                                    <div class="card-header">
                                        #{{ $test->id}} - {{ $test->name }}
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $test->name }}</h5>
                                        <p class="card-text"></p>
                                        <a href="{{ route('student.test.show', [$course, $lesson, $test]) }}"
                                            class="btn btn-outline-primary">Start Test</a>
                                    </div>
                                </div>
                                @endforeach
                                @foreach ($discussions as $discussion)
                                <div class="card mt-3">
                                    <div class="row">
                                        <div class="col">
                                            <div class="d-flex flex-start">
                                                <img class="rounded-circle shadow-1-strong me-3"
                                                    width="10" height="65" />
                                                <div class="flex-grow-1 flex-shrink-1">
                                                    <div>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p class="mb-1">
                                                                {{ $discussion->author }}
                                                                <span class="small text-secondary"> {{ $discussion->created_at }}</span>
                                                            </p>
                                                        </div>
                                                        <p class="small mb-0">
                                                            {{ $discussion->content }}
                                                        </p>
                                                    </div>
                                                    @foreach($discussion->comments as $comment)
                                                    @php
                                                        $authors = explode('_', $comment->created_by);
                                                    if(strcmp($authors[0], "te") == 0)
                                                        $author = DB::table('teachers')->where('id', $authors[1])->get('name')->toArray();
                                                        $comment->author = $author[0]->name;
                                                    if(strcmp($authors[0], "stu") == 0)
                                                        $author = DB::table('students')->where('id', $authors[1])->get('name')->toArray();
                                                        $comment->author = $author[0]->name;
                                                    @endphp
                                                    <div class="d-flex flex-start mt-4">
                                                        <a class="me-3" href="#">
                                                            <img class="rounded-circle shadow-1-strong" width="65"
                                                                height="10" />
                                                        </a>
                                                        <div class="flex-grow-1 flex-shrink-1">
                                                            <div>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <p class="mb-1">
                                                                        {{ $comment->author }} <span class="small text-secondary">{{ $comment->created_at }}</span>
                                                                    </p>
                                                                </div>
                                                                <p class="small mb-0">
                                                                    {{ $comment->content }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    <div class="d-flex flex-start mt-4">
                                                        <a class="me-3" href="#">
                                                            <img class="rounded-circle shadow-1-strong" width="65"
                                                                height="65" />
                                                        </a>
                                                        <div class="flex-grow-1 flex-shrink-1">
                                                            <form
                                                                action="{{ route('student.comment.store', [$course, $lesson, $discussion]) }}"
                                                                method="POST">
                                                                @csrf
                                                                <input id="content" type="text"
                                                                    class="form-control @error('content') is-invalid @enderror"
                                                                    placeholder="Leave Comment here" name="content"
                                                                    value="{{ old('content') }}" required
                                                                    autocomplete="content" autofocus>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <form action="{{ route('student.discussion.store', [$course, $lesson]) }}"
                                    method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="input-group mb-3">
                                            <input id="content" type="text"
                                                class="form-control @error('content') is-invalid @enderror"
                                                name="content" value="{{ old('content') }}" required
                                                autocomplete="content" autofocus>
                                            <button class="btn btn-outline-secondary" type="submit">Discussion</button>
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
