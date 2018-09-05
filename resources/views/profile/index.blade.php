@extends('layouts.main')

@section('title')
	{{ $user->username }} - Profile Page
@endsection

@section('content')
	<div class="row">
		<div class="col-lg-7">
			@include('user.partials.userblock')
			<hr>
		</div>

		<div class="col-lg-5 col-lg-offset-3">
			@if (Auth::user()->hasFriendRequestsPending($user))
				<p>
				Waiting for {{ $user->getName() }} to accept your request.
				</p>
			@elseif (Auth::user()->hasFriendRequestsReceived($user))
				<a href="{{ route('friend.accept', $user->username) }}" class="btn btn-primary">Accept Friend Request</a>
			@elseif (Auth::user()->isFriendsWith($user))
				<p>
				You and {{ $user->getName() }} are friends.
				</p>
			@elseif (Auth::user()->username !== $user->username)
				<a href="{{ route('friend.add', $user->username) }}" class="btn btn-primary">Add as friend</a>
			@endif

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
