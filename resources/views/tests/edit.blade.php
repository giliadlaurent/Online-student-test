@extends('layouts.base') @section('content')
<div class="container-fluid">
    <div class="col-md-6 col-md-offset-3">
        @include('shared.session-flash') @include('shared.validation-errors')

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"> <i class="glyphicon glyphicon-edit"></i>: {{ mb_strtoupper($test->title) }}</h3>
            </div>
            <div class="panel-body">
                <form method="POST" action="/{{ Auth::user()->getAdminPath() }}/tests/{{ $test->id }}/edit">
                    {{ csrf_field() }} {{ method_field('PATCH') }}
                    <div class="form-group">
                        <label>Title</label>
                        <input
                            type="text"
                            class="form-control"
                            name="title"
                            value="{{ $test->title }}"
                            required
                            maxlength="255"
                        />
                    </div>
                    <div class="form-group">
                        <label>Number of Questions</label>
                        <input
                            type="number"
                            class="form-control"
                            name="question_count"
                            value="{{ $test->question_count }}"
                            min="1"
                            required
                        />
                    </div>
                    <div class="form-group">
                        <label>Number of Wrong Questions Allowed</label>
                        <input
                            type="number"
                            class="form-control"
                            name="question_count_to_fail"
                            value="{{ $test->question_count_to_fail }}"
                            min="0"
                        />
                    </div>
                    <div class="form-group">
                        <label>Time Limit</label>
                        <select class="form-control" name="time_limit">
                            <option value="0">No time limit</option>
                            <option value="1800">30 Min</option>
                            <option value="3600">60 Min</option>
                            <option value="5400">90 Min</option>
                            <option value="7200">120 Min</option>
                        </select>
                    </div>
                    @if (Auth::user()->isAdministrator())
                    <div class="form-group">
                        <label>Group</label>
                        <select class="form-control" name="group_id">
                            @foreach ($groups as $group) @if ($group->id == $test->group_id)
                            <option value="{{ $group->id }}" selected>{{ $group->name }}</option>
                            @else
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endif @endforeach
                        </select>
                    </div>
                    @endif
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop