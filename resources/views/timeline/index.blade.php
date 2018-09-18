@extends('layouts.main')

@section('title')
	HomePage
@endsection

@section('content')
	<div class="row">
		<div class="col-lg-6">
			<form action="{{ route('status.post') }}" method="POST" role="form">
				{{ csrf_field() }}

				<div class="form-group">
					<textarea placeholder="What's up {{ Auth::user()->getFirstName() }}?" name="status" rows="2" class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" ></textarea>

					@if ($errors->any())
						<div class="invalid-feedback">
							@foreach ($errors->get('status') as $e)
								{{ $e }}
							@endforeach
						</div>
					@endif
				</div>

				<button class="btn btn-primary" type="submit">Update</button>
			</form>
		</div>
	</div>

	<hr>

	<div class="row">
		<div class="col-lg-5">
			@if (!$statuses->count())
				<p>No posts yet...</p>
			@else
				@foreach ($statuses as $status)
					@include('status.index')
				@endforeach

				{{ $statuses->render() }}
			@endif
		</div>
	</div>
@endsection
