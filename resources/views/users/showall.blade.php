@extends('layouts.base')

@section('content')

@include('shared.delete-modal')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @include('shared.session-flash')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Users</h4>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>
                                <form method="get">
                                    <button class="btn btn-sm btn-primary pull-right"
                                        formaction="/{{ Auth::user()->getAdminPath() }}/users/new">Add User</button>
                                </form>
                            </th>
                        </tr>

                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="{{ action('AdministrativeUserController@showUser',$user->id) }}">{{ $user->name }}
                                    ({{ $user->email }})</a></td>
                            <td>
                                <form method="get" class="pull-right">
                                    @if (Auth::user()->isAdministrator() AND $user->group_id === Auth::user()->group_id)
                                    @can('delete', User::class)
                                    <button type="button" class="btn btn-sm btn-danger pull-left" data-toggle="modal"
                                        data-target=".delete-modal" data-url="users"
                                        data-id="{{ $user->id }}">Delete</button>
                                    @endcan
                                    @endif
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop