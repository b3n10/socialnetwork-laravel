<div class="media">
	<!-- thumbnail -->
	<a class="pull-left" href="{{ $reply->user->username }}">
		<img class="media-object pb-2 pr-2 pt-1" src="{{ $reply->user->getAvatarUrl() }}" alt="{{ $reply->user->username }}">
	</a>

	<div class="media-body">
		<!-- username -->
		<h5 class="media-heading">
			<a href="{{ route('profile.index', ['username' => $reply->user->username]) }}">
				{{ $reply->user->getName() }}
			</a>
		</h5>

		<!-- main text -->
		<p>
		{{ $reply->body }}
		</p>

		<!-- text info -->
		<ul class="list-inline">
			<li class="list-inline-item">
				<span style="font-size: 13px;">
					{{ $reply->created_at->diffForHumans() }}
				</span>
			</li>
			@if ($reply->user->id !== Auth::user()->id)
				<li class="list-inline-item">
					<span class="badge">
						<a href="{{ route('status.like', [ 'statusId' => $reply->id ]) }}">
							@if (Auth::user()->hasLikedStatus(App\Models\Status::find($reply->id)))
								Liked
							@else
								Like
							@endif
						</a>
					</span>
				</li>
				<li class="list-inline-item">
					@if (Auth::user()->getLikeCount($reply->id))
						<span class="badge badge-primary badge-pill">
							{{ Auth::user()->getLikeCount($reply->id) }}{{ ' likes'}}
						</span>
					@endif
				</li>
			@endif
		</ul>
	</div>
</div>
