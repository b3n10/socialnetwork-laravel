<div class="media">
	<img class="mr-3" src="#" alt="{{ $user->getName() }}">
	<div class="media-body">
		<h5 class="mt-0">
			<a href="#">
				{{ $user->getName() }}
			</a>
		</h5>
		@if ($user->location)
			<p>{{ $user->location }}</p>
		@endif
	</div>
</div>
