<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
	<div class="container">
		<a class="navbar-brand" href="{{ route('home') }}">Socio</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse flex-row-reverse" id="navbarsExample07">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="{{ route('auth.signup') }}">Sign up</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('auth.signin') }}">Sign in</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
