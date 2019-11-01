@extends('layouts.base')

@section('content')

<div class="container-fluid">
    <div class="col-md-6 col-md-offset-3">
        @include('shared.session-flash')
        @include('shared.validation-errors')

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Add Test</h3>
            </div>
            <div class="panel-body">
               <form method="POST" action="/{{ Auth::user()->getAdminPath() }}/tests/new">
            {{ csrf_field() }}  {{-- Create Test</h3>/{{ Auth::user()->getAdminPath() }}/tests/new --}}
            <div class="form-group">      
                <label>Title</label>
                <input type="text" class="form-control" name="title" title="Add title of question" required maxlength="255">
            </div>
            <div class="form-group">
                <label>Number of Questions</label>
                <input type="number" class="form-control" name="question_count" min="1" required>
            </div>
            <div class="form-group">
                <label>Number of Wrong Questions Allowed</label>
                <input type="number" class="form-control" name="question_count_to_fail" min="0">
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
                    @foreach ($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ action('AdminController@showGroupTests',$group->id) }}" class="btn btn-danger pull-right">Back</a>
        </form>
          @endif
            </div>
        </div>
    </div>
</div>

@stop