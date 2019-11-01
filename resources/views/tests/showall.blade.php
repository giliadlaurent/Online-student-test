@extends('layouts.base')

@section('content')

@include('shared.delete-modal')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @include('shared.session-flash')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Tests</h4>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th>Test</th>
                            <th>
                                <form method="get">
                                    <button class="btn btn-sm btn-primary pull-right"
                                        formaction="/{{ Auth::user()->getAdminPath() }}/tests/new">Add Test</button>
                                </form>
                            </th>
                        </tr>
                        @foreach ($tests as $test)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><a
                                    href="/{{ Auth::user()->getAdminPath() }}/tests/{{ $test->id }}">{{ $test->title }}</a>
                            </td>
                            @if (Auth::user()->isAdministrator() || (Auth::user()->isModerator() AND $test->group_id ===
                            Auth::user()->group_id))
                            <td>

                                <form method="POST"
                                    action="{{action('AdministrativeTestController@deleteTest',$test->id)}}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-sm btn-danger pull-right">Delete</button>
                                </form>
                            </td>
                            @else
                            <td>
                                <button class="btn btn-sm btn-danger pull-right" formaction="#" disabled>Delete</button>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                    {{-- {{ $tests->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@stop