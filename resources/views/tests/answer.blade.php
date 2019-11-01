@extends('layouts.base')

@section('content')

<div class="container-fluid">
    <div class="col-md-6 col-md-offset-3">
        @include('shared.session-flash')
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Question {{ session("question_counter")-1 }}</h4>
            </div>
            <div class="panel-body">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                        aria-valuemax="100"
                        style="width: {{ session("test")->progressBarWidth(session("question_counter")-1) }}%;">
                        {{ session("question_counter")-1 }}/{{ session("test")->question_count }}
                    </div>
                </div>
                <h4><strong>{{ $question->title }}</strong></h4>
                <p>{{ $question->question }}</p>
                <hr>
                <form method="get" action="/test/question">
                    {{ csrf_field() }}
                    @foreach ($options as $option)
                    @if ($answers->where("id", $option->id)->first() && $option->correct_answer)
                    <div class="alert alert-success">
                        <p>
                            <span class="glyphicon glyphicon-ok" aria-hidden="true" style="color: green;"></span>
                            &nbsp;
                            {{ $option->option }}
                        </p>
                    </div>
                    @elseif ($answers->where("id", $option->id)->first() && !$option->correct_answer)
                    <div class="alert alert-danger">
                        <p>
                            <span class="glyphicon glyphicon-remove" aria-hidden="true" style="color: red;"></span>
                            &nbsp;
                            {{ $option->option }}
                        </p>
                    </div>
                    @elseif ($option->correct_answer)
                    <div>
                        <p>
                            <span class="glyphicon glyphicon-ok" aria-hidden="true" style="color: green;"></span>
                            &nbsp;
                            {{ $option->option }}
                        </p>
                    </div>
                    @else
                    <div>
                        <p>{{ $option->option }}</p>
                    </div>
                    @endif
                    @endforeach
                    @if (session("has_failed") == true)
                    <button type="submit" class="btn btn-default"
                        formaction="/test/{{ $question->test_id }}/retry">Retry</button>
                    <button type="submit" class="btn btn-default"
                        formaction="/test/{{ $question->test_id }}/end">End</button>
                    @elseif (session("last_question") == true)
                    <button type="submit" class="btn btn-success"
                        formaction="/test/{{ $question->test_id }}/end">End</button>
                    @else
                    <button type="submit" class="btn btn-primary" formaction="/test/question">Next</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

@stop