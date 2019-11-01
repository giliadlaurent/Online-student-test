@extends('layouts.base')

@section('content')

@include('shared.delete-modal')

@include('shared.reset-password-modal')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @include('shared.session-flash')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><span class="glyphicon glyphicon-user "></span></h4>
                </div>
                <div class="panel-body">
                    @if (Auth::user()->isAdministrator() ) {{-- AND $user->group_id === Auth::user()->group_id --}}
                    <form method="get">
                        @can('delete', $user)
                        <button type="button" class="btn btn-sm btn-danger pull-right" data-toggle="modal"
                            data-target=".delete-modal" data-url="users" data-id="{{ $user->id }}">Delete</button>
                        @endcan
                        @can('update', $user)
                        <button class="btn btn-sm btn-default pull-right"
                            formaction="/{{ Auth::user()->getAdminPath() }}/users/{{ $user->id }}/edit">Edit</button>
                        @endcan
                        @can('resetPassword', $user)
                        <button type="button" class="btn btn-sm btn-default pull-right" data-toggle="modal"
                            data-target=".reset-password-modal" data-id="{{ $user->id }}">Reset Password</button>
                        @endcan
                    </form>
                    @endif
                    <strong>Name:</strong><br>
                    {{ $user->name }}
                    <br>
                    <br>
                    <strong>Email:</strong><br>
                    {{ $user->email }}
                    <br>
                    <br>
                    <strong>Enabled:</strong><br>
                    {{ $user->enabled }}
                    @if (Auth::user()->isAdministrator())
                    <br>
                    <br>
                    <strong>Group:</strong><br>
                    {{ $group->name }}
                    <br>
                    <br>
                    <strong>Access Level:</strong><br>
                    {{ $user->access_level }}
                    @endif
                </div>
            </div>

            @endsection