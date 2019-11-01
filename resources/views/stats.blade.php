@extends('layouts.base') @section('content')

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Students Results</h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>N# Test</th>
                        <th>Name</th>
                        <th>Test Passed</th>
                        <th>Correct Answer</th>
                        <th>Last Passed</th>
                        <th>Fails</th>
                        <th>N# Of Question</th>
                        <th>Total Scores</th>
                    </tr>
                </thead>
                <tbody>
                    @if (Auth::user()->access_level== 1 or 2) @foreach ($results as $result)
                    <tr>
                        <td>{{ $result->id}}</td>
                        @if (!Auth::user()->isModerator() and Auth::user()->access_level== 1 )
                        <td>{{ Auth::user()->name}}</td>
                        @endif

                        <td>{{ $result->passed }}</td>
                        <td>{{ $result->correct_answers }}</td>
                        <td>{{ $result->last_passed }}</td>
                        <td>{{ $result->fails }}</td>
                        <td>{{ $result->question_count }}</td>
                        <td>{{ ($result->correct_answers/(2))/100 }}%</td>
                    </tr>
                    @endforeach @endif
                </tbody>
                <a href="/home" class="btn btn-primary float-right btn-xs" title="back to test">Test</a>
            </table>
        </div>
    </div>
</div>
@endsection