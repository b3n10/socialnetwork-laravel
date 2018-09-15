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
					<!-- start .media -->
					<div class="media">
						<a href="{{ route('profile.index', ['username' => $status->user->username]) }}">
							<img class="mr-3" src="{{ $status->user->getAvatarUrl() }}" alt="{{ $status->user->username }}">
						</a>

						<!-- start .media-body -->
						<div class="media-body">
							<h4 class="mt-0">
								<a href="{{ route('profile.index', ['username' => $status->user->username]) }}">
									{{ $status->user->getName() }}
								</a>
							</h4>

							<p>
							{{ $status->body }}
							</p>

							<ul class="list-inline">
								<li class="list-inline-item">
									<span style="font-size: 13px;">
										{{ $status->created_at->diffForHumans() }}
									</span>
								</li>
								<li class="list-inline-item">
									<span class="badge">
										<a href="#">Like</a>
									</span>
								</li>
								<li class="list-inline-item">
									<span class="badge badge-primary badge-pill">
										{{ 'X likes' }}
									</span>
								</li>
							</ul>

							<!-- start replies -->
							@foreach ($status->replies as $reply)
								<div class="media">
									<a class="pull-left" href="{{ $reply->user->username }}">
										<img class="media-object pb-2 pr-2 pt-1" src="{{ $reply->user->getAvatarUrl() }}" alt="{{ $reply->user->username }}">
									</a>
									<div class="media-body">
										<h5 class="media-heading">
											<a href="{{ route('profile.index', ['username' => $reply->user->username]) }}">
												{{ $reply->user->getName() }}
											</a>
										</h5>
										<p>{{ $reply->body }}</p>
										<ul class="list-inline">
											<li class="list-inline-item">
												<span style="font-size: 13px;">
													{{ $reply->created_at->diffForHumans() }}
												</span>
											</li>
											<li class="list-inline-item">
												<span class="badge">
													<a href="#">
														Like
													</a>
												</span>
											</li>
											<li class="list-inline-item">
												<span class="badge badge-primary badge-pill">
													{{ 'X likes' }}
												</span>
											</li>
										</ul>
									</div>
								</div>
							@endforeach
							<!-- end replies -->

						</div>
						<!-- end .media-body -->
					</div>
					<!-- end .media -->

					<!-- if user is friends with userprofile or user is viewing own profile -->
					@if ($authUserIsFriend || Auth::user()->id === $user->id)
						<form action="{{ route('status.reply', [ 'statusId' => $status->id ]) }}" method="POST" role="form">
							{{ csrf_field() }}

							<div class="form-group">
								<textarea name="reply-{{ $status->id }}" class="form-control{{ $errors->has("reply-{$status->id}") ? ' is-invalid' : '' }}" placeholder="Reply to this status..." rows="2"></textarea>

								@if ($errors->has("reply-{$status->id}"))
									<div class="invalid-feedback">
										{{ $errors->first("reply-{$status->id}") }}
									</div>
								@endif
							</div>

							<button class="btn btn-default btn-sm mb-3" type="submit">Reply</button>
						</form>
					@endif

				@endforeach
			@endif
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
