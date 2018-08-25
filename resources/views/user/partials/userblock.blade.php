<div class="media">
	<a href="{{ route('profile.index', ['username' => $user->username]) }}">
		<img class="mr-3" src="{{ $user->getAvatarUrl() }}" alt="{{ $user->getName() }}">
	</a>
	<div class="media-body">
		<h5 class="mt-0">
			<a href="{{ route('profile.index', ['username' => $user->username]) }}">
				{{ $user->getName() }}
			</a>
		</h5>
		@if ($user->location)
			<p>{{ $user->location }}</p>
		@endif
	</div>
</div>
