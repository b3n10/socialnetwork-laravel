@extends('layouts.main')

@section('content')
	@if ($users->count())
		<h4>
			{{ $results_string }}
		</h4>

		@section('title')
			{{ $results_string }}
		@endsection

		@foreach ($users as $user)
			@include('user.partials.userblock')
		@endforeach
	@else
		<h4>
			{{ $results_string }}
		</h4>

		@section('title')
			{{ $results_string }}
		@endsection
	@endif
@endsection
