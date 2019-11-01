@extends('layouts.base')

@section('content')

<div class="container-fluid">
    <div class="col-md-6 col-md-offset-3">
        @include('shared.session-flash')
        @include('shared.validation-errors')
        <h1>Edit Group: {{ $group->name }}</h1>
        </br>
        <form method="POST" action="{{ action('GroupController@editGroup',$group->id) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="{{ $group->name }}" required maxlength="255">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>


@stop