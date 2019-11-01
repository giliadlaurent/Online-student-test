@extends('layouts.base') @section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @include("shared.session-flash") @if(!Auth::user()->isAdministrator() == auth()->user()->group->id)
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong><span class="glyphicon glyphicon-exclamation-sign"></span>Marks !</strong>
                Each Question Has  2 Marks
               {{--  <a href="/instructions">Instructions</a> --}}
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Tests</h4>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th>Test</th>
                            <th>Nr. of Questions</th>
                            <th>Time limit</th>
                            <th></th>
                        </tr>

                        @foreach ($tests[0] as $test)
                        <tr>
                            <td>{{ $test->title }}</td>
                            <td>{{ $test->question_count }}</td>
                            @if ($test->time_limit === 0)
                            <td>Unlimited</td>
                            @else
                            <td>{{ $test->timeLimitInMinutes() }} min.</td>
                            @endif
                            <td>
                                <form method="get" class="pull-right">
                                    <button class="btn btn-xs btn-primary pull-left" formaction="/test/{{ $test->id }}">
                                        Start
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Completed Tests</div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th>Test</th>
                            <th>Nr. of Questions</th>
                            <th>Date Completed</th>
                        </tr>
                        @foreach ($tests[1] as $test)
                        <tr>
                            <td>{{ $test->title }}</td>
                            <td>{{ $test->question_count }}</td>
                            <td>{{ $tests[2]->where("test_id", $test->id)->first()->last_passed }}</td>
                        </tr>
                        @endforeach
                    </table>

                    <a href="/stats" class="btn btn-primary float-right btn-xs " title="Click to see result">Result</a>
                </div>
            </div>
            @else
            <img class="img-fluid" src="{{asset('images/m.jpg')}}" alt="" />

            @endif
        </div>
    </div>
</div>
@endsection