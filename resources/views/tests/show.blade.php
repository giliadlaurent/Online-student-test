@extends('layouts.base')

@section('content')

@include('shared.delete-modal')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @include('shared.session-flash')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Test</h4>
                </div>
                <div class="panel-body">
                    @if (Auth::user()->isAdministrator() || (Auth::user()->isModerator() AND $test->group_id ===
                    Auth::user()->group_id))
                    <form method="get">
                        <button type="button" class="btn btn-sm btn-danger pull-right" data-toggle="modal"
                            data-target=".delete-modal" data-url="tests" data-id="{{ $test->id }}">Delete</button>
                        <button class="btn btn-sm btn-default pull-right"
                            formaction="/{{ Auth::user()->getAdminPath() }}/tests/{{ $test->id }}/edit">Edit</button>
                    </form>
                    @endif
                    <strong>Title:</strong><br>
                    {{ $test->title }}
                    <br>
                    <br>
                    <strong>Question count:</strong><br>
                    {{ $test->question_count }}
                    <br>
                    <br>
                    <strong>Question Count to Fail:</strong><br>
                    {{ $test->question_count_to_fail }}
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Questions</h4>
                    @if (Auth::user()->isAdministrator() || (Auth::user()->isModerator() AND $test->group_id ===
                    Auth::user()->group_id))
                    <form method="get" class="pull-right">
                        <button class="btn btn-sm btn-primary pull-left addquestion"
                            formaction="/{{ Auth::user()->getAdminPath() }}/tests/{{ $test->id }}/question">Add
                            Question</button>
                    </form>
                    @endif
                </div>
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    @foreach ($questions as $question)
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading{{ $question->id }}">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                href="#collapse{{ $question->id }}" aria-expanded="false"
                                aria-controls="collapse{{$question->id}}">
                                {{ $question->title }} <span class="caret"></span>
                            </a>
                            @if (Auth::user()->isAdministrator() || (Auth::user()->isModerator() AND $test->group_id ===
                            Auth::user()->group_id))
                            <form method="get" class="pull-right">
                                <button class="btn btn-sm btn-default pull-left"
                                    formaction="/{{ Auth::user()->getAdminPath() }}/questions/{{ $question->id }}/edit">Edit</button>
                                <button type="button" class="btn btn-sm btn-danger pull-left" data-toggle="modal"
                                    data-target=".delete-modal" data-url="questions"
                                    data-id="{{ $question->id }}">Delete</button>
                            </form>
                            @endif
                        </div>
                        <div id="collapse{{ $question->id }}" class="panel-collapse collapse" role="tabpanel"
                            aria-labelledby="heading{{ $question->id }}">
                            <div class="panel-body">
                                {{ $question->question }}
                            </div>
                            <ul class="list-group question-options">
                                @foreach ($question->options as $option)
                                <li class="list-group-item">{{ $option->option }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@stop