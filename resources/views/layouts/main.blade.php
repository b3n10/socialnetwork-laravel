<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	<link rel="stylesheet" href="{{ asset('css/bootstrap_4.1.3.min.css') }}">
</head>
<body>
	@include('layouts.partials.navigation')
	<div class="container">
		@include('layouts.partials.alerts')
		@yield('content')
	</div>
</body>
</html>
