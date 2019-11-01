@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <div class="col-md-6 col-md-offset-3">
        @include('shared.session-flash')
        @include('shared.validation-errors')

     <div class="panel panel-info">
         <div class="panel-heading">
             <h3 class="panel-title"><span class="glyphicon glyphicon-edit"></span> :{{ $user->name }}</h3>
         </div>
         <div class="panel-body">
             <form method="POST" action="/{{ Auth::user()->getAdminPath() }}/users/{{ $user->id }}/edit">
            {{ csrf_field() }}
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="{{ $user->name }}" required maxlength="255">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" value="{{ $user->email }}" required
                    maxlength="255">
            </div>
            <div class="form-group">
                <div class="pull-right">
                    <label>Reset password</label>
                    <input id="reset-password-check" type="checkbox" name="reset_password">
                    <label>Manually change password</label>
                    <input id="manual-password-check" type="checkbox" name="type_password">
                </div>
                <label>Password</label>
                <input id="manual-password-field" type="password" class="form-control" name="password" disabled
                    required>
            </div>
            <div class="form-group">
                <label>Enabled</label>
                <select name="enabled" class="form-control">
                    <option value="1" @if ($user->enabled === 1) selected @endif>Yes</option>
                    <option value="0" @if ($user->enabled === 0) selected @endif>No</option>
                </select>
            </div>
            @if (Auth::user()->isModerator())
            <div class="form-group">
                <label>Access Level</label>
                <select name="access_level" class="form-control">
                    <option value="1" @if ($user->access_level === 1) selected @endif>User</option>
                    <option value="2" @if ($user->access_level === 2) selected @endif>Moderator</option>
                </select>
            </div>
            @elseif (Auth::user()->isAdministrator())
            <div class="form-group">
                <label>Access Level</label>
                <select name="access_level" class="form-control">
                    <option value="1" @if ($user->access_level === 1) selected @endif>User</option>
                    <option value="2" @if ($user->access_level === 2) selected @endif>Moderator</option>
                    <option value="3" @if ($user->access_level === 3) selected @endif>Administrator</option>
                </select>
            </div>
            <div class="form-group">
                <label>Group</label>
                <select class="form-control" name="group_id">
                    @foreach ($groups as $group)
                    <option value="{{ $group->id }}" @if ($group->id === $user->group_id) selected
                        @endif>{{ $group->name }}</option>
                    @endforeach
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