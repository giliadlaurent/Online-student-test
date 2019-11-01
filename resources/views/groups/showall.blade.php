@extends('layouts.base')

@section('content')

@include('shared.delete-modal')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @include('shared.session-flash')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Groups</h4>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th>Group</th>
                            <th>
                                <form method="get" action="">
                                    {{ csrf_field() }}
                                    <a href="{{ url('new') }}" class="btn btn-sm btn-primary pull-right">Add Group</a>
                                </form>
                            </th>
                        </tr>
                        @foreach ($groups as $group)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="{{ url('admin/groups',$group->id) }}">{{ $group->name }}</a></td>
                            <td>
                                @if(auth::user()->isAdministrator())
                                <form method="GET" class="pull-right" action="">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    {{-- <a href="{{ action('GroupController@Delete',$group->id) }}" type="button"
                                    class="btn btn-sm btn-danger pull-left" >Delete</a> --}}
                                    <button type="button" class="btn btn-sm btn-danger pull-left" data-toggle="modal"
                                        data-target=".delete-modal" data-url="groups"
                                        data-id="{{ $group->id }}">Delete</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {{ $groups->links() }}
                </div>



            </div>
        </div>
    </div>
</div>
@stop