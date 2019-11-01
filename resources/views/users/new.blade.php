@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <div class="col-md-6 col-md-offset-3">
        @include('shared.session-flash')
        @include('shared.validation-errors')

       <div class="panel panel-default">
        <div class="panel panel-heading">
            @lang('language.create')
        </div>
           <div class="panel-body">
                 <form method="POST" action="{{ action('AdministrativeUserController@addUser') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" required maxlength="255">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" required maxlength="16">
            </div>
            <div class="form-group">
                <div class="pull-right">
                    <label>Manually type password</label>
                    <input id="manual-password-check" type="checkbox" name="type_password">
                </div>
                <label>Password</label>
                <input id="manual-password-field" type="password" class="form-control" name="password" disabled
                    required>
            </div>
            <div class="form-group">
                <label>Enabled</label>
                <select name="enabled" class="form-control">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            @if (Auth::user()->isModerator())
            <div class="form-group">
                <label>Access Level</label>
                <select name="access_level" class="form-control">
                    <option value="1">User</option>
                    <option value="2">Moderator</option>
                </select>
            </div>
            @elseif (Auth::user()->isAdministrator())
            <div class="form-group">
                <label>Access Level</label>
                <select name="access_level" class="form-control">
                    <option value="1">User</option>
                    <option value="2">Moderator</option>
                    <option value="3">Administrator</option>
                </select>
            </div>
            <div class="form-group">
                <label>Group</label>
                <select class="form-control" name="group_id">
                    @foreach ($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>
            @endif
            <button type="submit" class="btn btn-primary">Submit</button>
             <a href="/admin"  class="btn btn-danger pull-right ">home</a>
        </form>
           </div>
       </div>
    </div>
</div>

@stop