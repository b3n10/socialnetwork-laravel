@extends('layouts.main')

@section('content')
	@if ($users->count())
		<h4>
			Search results found {{ $users->count() }} user(s)
		</h4>
		@foreach ($users as $user)
			@include('user.partials.userblock')
		@endforeach
	@else
		<h4>No results found!</h4>
	@endif
@endsection
