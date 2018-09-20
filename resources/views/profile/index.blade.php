@extends('layouts.main')

@section('title')
	{{ $user->username }} - Profile Page
@endsection

@section('content')
	<div class="row">
		<div class="col-lg-7">
			@include('user.partials.userblock')
			<hr>

			@if (!$statuses->count())
				<p>{{ $user->getName() }} has no posts yet...</p>
			@else
				@foreach ($statuses as $status)
					@include('status.index')
				@endforeach
			@endif
		</div>

		<div class="col-lg-5 col-lg-offset-3">
			@if (Auth::user()->hasFriendRequestsPending($user))
				<p>
				Waiting for {{ $user->getName() }} to accept your request.
				</p>
			@elseif (Auth::user()->hasFriendRequestsReceived($user))
				<p>
				{{ $user->first_name }} wants to add you as friend.

					<p>
						<a href="{{ route('friend.accept', $user->username) }}" class="btn btn-primary">
							Accept Friend Request
						</a>
					</p>
				</p>
				<hr>
			@elseif (Auth::user()->isFriendsWith($user))
				<p>
					You and {{ $user->getName() }} are friends.

					<form action="{{ route('friend.delete', $user->username) }}" method="POST" role="form">
						{{ csrf_field() }}
						<button class="btn btn-danger">
							Unfriend {{ $user->getFirstName() }}
						</button>
					</form>
				</p>
				<hr>
			@elseif (Auth::user()->username !== $user->username)
				<p>
					You and {{ $user->getName() }} are not yet friends.

					<p>
						<a href="{{ route('friend.add', $user->username) }}" class="btn btn-primary">
							Add as friend
						</a>
					</p>
				</p>
				<hr>
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
