@extends('layouts.main')

@section('title')
	Socio - Sign Up
@endsection

@section('content')
	<h3>Sign Up</h3>
	<div class="col col-md-7">
		<form action="{{ route('auth.signup')}}" method="POST">
			{{ csrf_field() }}

			<div class="form-group">
				<label for="email">Email address</label>

				<input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" aria-describedby="emailHelp" placeholder="Enter email" value="{{ old('email') }}">

				@if ($errors->any())
					<div class="{{ $errors->has('email') ? 'invalid-feedback' : '' }}">
						@foreach ($errors->get('email') as $e)
							{{ $e }}
						@endforeach
					</div>
				@endif
			</div>

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

			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
@endsection
