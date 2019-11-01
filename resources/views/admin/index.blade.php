@extends('layouts.base')

@section('content')
<div class="container-fluid">
	<div class="col-md-6 col-md-offset-3">
		@include('shared.session-flash')
        <div class="panel panel-info">
        	<div class="panel-heading">
        		<h3 class="panel-title"><span class="glyphicon glyphicon-plus"></span> Manage User,Group and Test</h3>
        	</div>
        	<div class="panel-body">
        				<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Tests</h4>
			</div>
			<div class="panel-body">
				<form method="get">
					<button formaction="/{{ Auth::user()->getAdminPath() }}/tests" class="btn btn-default">Show
						Tests</button>
					<button formaction="/{{ Auth::user()->getAdminPath() }}/tests/new" class="btn btn-default">New
						Test</button>
				</form>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">Users</div>
			<div class="panel-body">
				<form method="get">
					<button formaction="/{{ Auth::user()->getAdminPath() }}/users" class="btn btn-default">Show
						Users</button>
					<button formaction="/{{ Auth::user()->getAdminPath() }}/users/new" class="btn btn-default">New
						User</button>
				</form>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">Groups</div>
			<div class="panel-body">
				<form method="get">
					@if (Auth::user()->isAdministrator())
					<a href="{{ url('admin/groups') }}" class="btn btn-default">Show Groups</a>
					<a href="{{ url('new') }}" class="btn btn-default">New Group</a>
					@else
					<a href="{{ url('new') }}" class="btn btn-default">New Group</a>
					<a href="{{ url('admin/groups') }}" class="btn btn-default">Show Group</a>
					@endif
				</form>
			</div>
		</div>
        	</div>
        </div>
	</div>
</div>
@stop