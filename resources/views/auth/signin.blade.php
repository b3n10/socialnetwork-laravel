@extends('layouts.main')

@section('title')
	Sign In
@endsection

@section('content')
	<div class="col col-md-7">
		<form action="{{ route('auth.signin')}}" method="POST">
			{{ csrf_field() }}

			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" name="username" class="form-control" id="username">
			</div>

			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" class="form-control" id="password">
			</div>

			<button type="submit" class="btn btn-primary">Log in</button>
		</form>
	</div>
@endsection
