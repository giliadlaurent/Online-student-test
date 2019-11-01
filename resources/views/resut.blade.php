@extends('layouts.base') @section('content')

<div class="container">
    <br />
    <br />
    <br />
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Students Result</h3>
        </div>
        <div class="panel-body">
            <table class="table table-light">
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
                    @forelse ($x as $result)
                    <tr>
                        <td>{{ $result->id }}</td>
                        <td>{{ $result->User->name }}</td>
                        <td>{{ $result->passed }}</td>
                        <td>{{ $result->correct_answers }}</td>
                        <td>{{ $result->last_passed }}</td>
                        <td>{{ $result->fails }}</td>
                        <td>{{ $result->test->question_count}}</td>
                        <td>{{ ($result->correct_answers/(2))/100 }}%</td>

                        @empty

                        <p class="btn btn-danger">No result</p>
                    </tr>

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{ $x->links() }}
</div>
@endsection