@extends('layouts.main')

@section('content')
	@if ($users->count())
		<h4>
			Search results found {{ $users->count() }} user(s)
		</h4>
		@foreach ($users as $user)
			@include('user.partials.userblock')
		@endforeach

		@section('title')
			Search results found {{ $users->count() }} user(s)
		@endsection
	@else
		<h4>No results found!</h4>

		@section('title')
			No results found!
		@endsection
	@endif
@endsection
