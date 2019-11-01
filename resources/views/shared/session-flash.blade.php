@if (session('status'))
<div class="alert alert-success alert-dismissable fade in">
	<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> {{ session('status') }}
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif
@if (session('status_failed'))
<div class="alert alert-danger alert-dismissable fade in">
	<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> {{ session('status_failed') }}
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif