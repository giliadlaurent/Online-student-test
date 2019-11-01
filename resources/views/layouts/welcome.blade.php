<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<!-- CSRF Token -->

		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<title>Laravel</title>
		<!-- Styles -->
		<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" />
		<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}" />

		<script>
			window.Laravel = <?php echo json_encode([
					'csrfToken' => csrf_token(),
				]); ?>
		</script>
	</head>

	<body style="background-image: url('{{asset('images/x.png')}}');width: auto;height: auto;">
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid"></div>
		</nav>
		<br />
		<br />
		<br />
		<br />
		@yield('content')
		<nav class="navbar navbar-inverse navbar-fixed-bottom">
			<div class="container-fluid">
				<p class="text-center text-light" id="text" style="padding-top: 20px">
					<span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span>
					Cive Product |Design by laurent Giliard
				</p>
			</div>
		</nav>
		<!-- Scripts -->
		<script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/bootstrap.min2.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
	</body>
</html>