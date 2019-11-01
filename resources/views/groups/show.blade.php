@extends('layouts.base')

@section('content')

@include('shared.delete-modal')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			@include('shared.session-flash')
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">Group</h4>

				</div>
				<div class="panel-body">
					@if (Auth::user()->isAdministrator() || (Auth::user()->isModerator() AND $group->id ===
					Auth::user()->group_id))
					<form method="GET" action="" class="form-controll">
						<a href="{{ action('GroupController@updateGroup',$group->id) }}" class="btn btn-sm btn-default pull-right">Edit</a>
						<a href="{{ action('GroupController@Delete',$group->id) }}"class="btn btn-sm btn-danger pull-right">Delete</a>
					</form>
					@endif
					<strong>Name:</strong> {{ $group->name }}
					<br>
					<br>
					@if (Auth::user()->isAdministrator())
					<strong>Enabled:</strong><br>
					{{ $group->enabled }}
					@endif
				</div>
			</div>

		</div>
	</div>
</div>
			@endsection