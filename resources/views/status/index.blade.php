<div class="media">
	<!-- thumbnail -->
	<a href="{{ route('profile.index', ['username' => $status->user->username]) }}">
		<img class="mr-3" src="{{ $status->user->getAvatarUrl() }}" alt="{{ $status->user->username }}">
	</a>

	<div class="media-body">
		<!-- username -->
		<h4 class="mt-0">
			<a href="{{ route('profile.index', ['username' => $status->user->username]) }}">
				{{ $status->user->getName() }}
			</a>
		</h4>

		<!-- main text -->
		<p>
		{{ $status->body }}
		</p>

		<!-- text info -->
		<ul class="list-inline">
			<li class="list-inline-item">
				<span style="font-size: 13px;">
					{{ $status->created_at->diffForHumans() }}
				</span>
			</li>
			@if ($status->user->id !== Auth::user()->id)
				<li class="list-inline-item">
					<span class="badge">
						<a href="{{ route('status.like', [ 'statusId' => $status->id ]) }}">
							@if (Auth::user()->hasLikedStatus(App\Models\Status::find($status->id)))
								Liked
							@else
								Like
							@endif
						</a>
					</span>
				</li>
				<li class="list-inline-item">
						@if (Auth::user()->getLikeCount($status->id))
							<span class="badge badge-primary badge-pill">
							{{ Auth::user()->getLikeCount($status->id) }} {{ str_plural('like', Auth::user()->getLikeCount($status->id)) }}
							</span>
						@endif
				</li>
			@endif
		</ul>

		<!-- replies -->
		@foreach ($status->replies as $reply)
			@include('status.replies')
		@endforeach

	</div>
</div>

@if (Auth::user()->isFriendsWith($status->user) || Auth::user()->id === $status->user->id)
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
