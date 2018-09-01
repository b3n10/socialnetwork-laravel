@extends('layouts.main')

@section('title')
	{{ $user->username }} - Profile Page
@endsection

@section('content')
	<div class="row">
		<div class="col-lg-5">
			@include('user.partials.userblock')
			<hr>
		</div>
		<div class="col-lg-4 col-lg-offset-3">
			<h4>
				{{ $user->getName() }}'s friends:
			</h4>

			@if (!$user->friends()->count())
				<p>
				{{ $user->getName() }} has no friends.
				</p>
			@else
				@foreach ($user->friends() as $user)
					@include('user.partials.userblock')
				@endforeach
			@endif
		</div>
	</div>
@endsection
