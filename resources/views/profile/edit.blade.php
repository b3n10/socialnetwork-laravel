@extends('layouts.main')

@section('title')
	{{ $user->username }} - Edit Profile Page
@endsection

@section('content')
	<h3>Update Profile</h3>

	<div class="row">
		<div class="col-lg-6">
			<form class="form-vertical" role="form" method="post" action="">
				{{ csrf_field() }}

				<div class="row">

					<div class="col-lg-6">
						<div class="form-group">
							<label for="first_name">First Name</label>
							<input type="text" id="first_name" name="first_name" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : ''}}" value="{{ old('first_name') ?: Auth::user()->first_name }}">

							@if ($errors->any())
								<div class="{{ $errors->has('first_name') ? 'invalid-feedback' : '' }}">
									@foreach ($errors->get('first_name') as $e)
										{{ $e }}
									@endforeach
								</div>
							@endif
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group">
							<label for="last_name">Last Name</label>
							<input type="text" id="last_name" name="last_name" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : ''}}" value="{{ old('last_name') ?: Auth::user()->last_name }}">

							@if ($errors->any())
								<div class="{{ $errors->has('last_name') ? 'invalid-feedback' : '' }}">
									@foreach ($errors->get('last_name') as $e)
										{{ $e }}
									@endforeach
								</div>
							@endif
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="location">Location</label>
					<input type="text" id="location" name="location" class="form-control {{ $errors->has('location') ? 'is-invalid' : ''}}" value="{{ old('location') ?: Auth::user()->location }}">

					@if ($errors->any())
						<div class="{{ $errors->has('location') ? 'invalid-feedback' : '' }}">
							@foreach ($errors->get('location') as $e)
								{{ $e }}
							@endforeach
						</div>
					@endif
				</div>

				<div class="form-group">
					<button class="btn btn-primary">Update</button>
				</div>

			</form>
		</div>
	</div>
@endsection
