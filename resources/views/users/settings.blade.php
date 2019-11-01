@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 ">
            @include('shared.session-flash')
            @include('shared.validation-errors')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Password</h4>
                </div>
                <div class="panel-body">
                    <form method="post" action="/settings/update/password">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="form-group">
                            <h4>Change Password</h4>
                            <label>Old Password</label>
                            <input type="password" class="form-control" name="password_old" required>
                            <br>
                            <label>New Password</label>
                            <input type="password" class="form-control" name="password" required>
                            <br>
                            <label>Repeat New Password</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Email</h4>
                </div>
                <div class="panel-body">
                    <form method="post" action="/settings/update/email">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="form-group">
                            <label>Reg#</label>
                            <input type="email" class="form-control " readonly name="email" value="{{ $user->email }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" readonly name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary disabled">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop