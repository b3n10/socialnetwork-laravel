<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
	<div class="container">
		<a class="navbar-brand" href="{{ route('home') }}">Socio</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarColor02">
			@if (Auth::check())
				<ul class="navbar-nav mr-5">
					<li class="nav-item">
						<a class="nav-link" href="#">Timeline<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Features</a>
					</li>
				</ul>

				<form class="form-inline">
					<input class="form-control mr-sm-2" type="search" placeholder="Find people" aria-label="Search" />
					<button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
				</form>
			@endif

			<ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
			@if (Auth::check())
				<li class="nav-item active">
					<a class="nav-link" href="#">{{ Auth::user()->getName() }}</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Update Profile<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('auth.signout') }}">Sign out</a>
				</li>
			@else
				<li class="nav-item">
					<a class="nav-link" href="{{ route('auth.signup') }}">Sign up</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('auth.signin') }}">Sign in</a>
				</li>
			@endif
			</ul>
		</div>

	</div>
</nav>
