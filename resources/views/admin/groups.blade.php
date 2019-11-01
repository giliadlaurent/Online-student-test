@extends('layouts.base') @section('content')
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
                                   <th colspan="2">Group</th>
                              </tr>
                              <tr>
                                   <td></td>
                                   <td>
                                        @if (request()->path() === "admin/tests" OR request()->path() === "mod/tests")
                                        <a href="/{{ Auth::user()->getAdminPath() }}/tests/all">Show All</a>

                                        @elseif (request()->path() == "admin/users")
                                        <a href="/{{ Auth::user()->getAdminPath() }}/users/all">Show All</a>
                                        @endif
                                   </td>
                              </tr>
                              @foreach ($groups as $group)
                              <tr>
                                   <td>{{ $loop->iteration }}</td>
                                   <td>
                                        @if (request()->path() == "admin/tests" OR request()->path() === "mod/tests")
                                        <a href="/{{ Auth::user()->getAdminPath() }}/tests/group/{{ $group->id }}">
                                             {{ $group->name }}
                                        </a>
                                        @elseif (request()->path() == "admin/users")
                                        <a href="/{{ Auth::user()->getAdminPath() }}/users/group/{{ $group->id }}">
                                             {{ $group->name }}
                                        </a>
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