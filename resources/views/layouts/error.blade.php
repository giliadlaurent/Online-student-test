<!DOCTYPE html>
<html>
	<head>
		<title>Sorry.</title>

		<style>
			html, body {
				height: 100%;
			}

			body {
				margin: 0;
				padding: 0;
				width: 100%;
				color: #B0BEC5;
				display: table;
				font-weight: 100;
				font-family: 'Lato', sans-serif;
			}

			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}

			.content {
				text-align: center;
				display: inline-block;
			}

			.title {

				margin-bottom: 40px;
			}
		</style>
	</head>
	<body>

        <!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}" />

		<title>Online Student Test</title>

		<!-- Styles -->
		<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" />
		<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}" />
		{{--
		<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-theme.mcss') }}" />
		--}}

		<script>
			  window.Laravel = <?php echo json_encode([
	'csrfToken' => csrf_token(),
]); ?>
		</script>
	</head>

	<body class="body">
		<br />
		<br />
		<br />
		<br />
		<nav class="navbar-inverse navbar-fixed-top ">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand " href="{{ url('/home') }}" id="text">
						@lang('language.ost')
					</a>
				</div>
				<div class="collapse navbar-collapse" id="app-navbar-collapse">
					<!-- Left Side Of Navbar -->

					<ul class="nav navbar-nav ">
						@if (Auth::user()->isadministrator())

						<li><a href="/result">@lang('language.result')</a></li>
						@endif
						@if(Auth::user()->isModerator())
						<li><a href="/stats">Student Results</a></li>
						@endif
						 @if(Auth::user()->access_level==1)
						<li><a href="/stats">@lang('language.result')</a></li>
						@endif

						@if (Auth::user()->isadministrator())
							<li><a href="/settings">@lang('language.setting')</a></li>
						 @endif

					</ul>

					<!-- Right Side Of Navbar -->
					<ul class="nav navbar-nav navbar-right">
						<!-- Authentication Links -->
						@if (Auth::guest())
						<li><a href="{{ url('/login') }}">Login</a></li>
						<!--<li><a href="{{ url('/register') }}">Register</a></li>-->
						@else
						<!-- Administration links -->
						@if (Auth::check()) @if (Auth::user()->isModerator())
						<li><a href="/mod">Moderator</a></li>
						@elseif (Auth::user()->isAdministrator())
						<li><a href="/admin">Management</a></li>
						@endif @endif
						<li class="dropdown">
							<a
								href="#"
								class="dropdown-toggle"
								data-toggle="dropdown"
								role="button"
								aria-expanded="false"
							>
								{{ Auth::user()->email }}
								<span class="caret"></span>
							</a>

							<ul class="dropdown-menu" role="menu">
								<li>
									<a
										href="{{ url('/logout') }}"
										onclick="event.preventDefault();
												 document.getElementById('logout-form').submit();"
									>
										Logout
									</a>

									<form
										id="logout-form"
										action="{{ url('/logout') }}"
										method="POST"
										style="display: none;"
									>
										{{ csrf_field() }}
									</form>
								</li>
							</ul>
						</li>
						@endif
					</ul>
				</div>
			</div>
		</nav>

		@yield('content')

		<script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>



	</body>
</html>