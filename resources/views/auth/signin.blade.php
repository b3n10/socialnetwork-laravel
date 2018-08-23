@extends('layouts.main')

@section('title')
	Socio - Sign In
@endsection

@section('content')
	<h3>Sign In</h3>
	<div class="col col-md-7">
		<form action="{{ route('auth.signin')}}" method="POST">
			{{ csrf_field() }}

			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" name="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" id="username" value="{{ old('username') }}">

				@if ($errors->any())
					<div class="{{ $errors->has('username') ? 'invalid-feedback' : '' }}">
						@foreach ($errors->get('username') as $e)
							{{ $e }}
						@endforeach
					</div>
				@endif
			</div>

			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password">

				@if ($errors->any())
					<div class="{{ $errors->has('password') ? 'invalid-feedback' : '' }}">
						@foreach ($errors->get('password') as $e)
							{{ $e }}
						@endforeach
					</div>
				@endif
			</div>

			<div class="form-group form-check">
				<input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember">
				<label class="form-check-label" for="exampleCheck1">Remember Me</label>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary">Log in</button>
			</div>

		</form>
	</div>
@endsection
