@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <div class="col-md-6 col-md-offset-3">
        @include('shared.session-flash')
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Question {{ session("question_counter") }}</h4>
            </div>
            <div class="panel-body">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                        aria-valuemax="100"
                        style="width: {{ session("test")->progressBarWidth(session("question_counter")) }}%;">
                        {{ session("question_counter") }}/{{ session("test")->question_count }}
                    </div>
                </div>
                <h4><strong>{{ $question->title }}</strong></h4>
                <p>{{ $question->question }}</p>
                <hr>
                <form method="post" action="/test/question">
                    {{ csrf_field() }}
                    @foreach ($options as $option)
                    <input type="{{ $question->question_type }}" name="answer{{ $option->id }}"
                        value="{{ $option->id }}"> {{ $option->option }}
                    </br>
                    </br>
                    @endforeach
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop