@extends('layouts.main')

@section('title')
	HomePage
@endsection

@section('content')
	<div class="row">
		<div class="col-lg-6">
			<form action="{{ route('status.post') }}" method="POST" role="form">
				{{ csrf_field() }}

				<div class="form-group">
					<textarea placeholder="What's up {{ Auth::user()->getFirstName() }}?" name="status" rows="2" class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" ></textarea>

					@if ($errors->any())
						<div class="invalid-feedback">
							@foreach ($errors->get('status') as $e)
								{{ $e }}
							@endforeach
						</div>
					@endif
				</div>

				<button class="btn btn-primary" type="submit">Update</button>
			</form>
		</div>
	</div>

	<hr>

	<div class="row">
		<div class="col-lg-5">
			@if (!$statuses->count())
				<p>No posts yet...</p>
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
									<span class="badge">
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
										{{ '2 likes' }}
									</span>
								</li>
							</ul>
						</div>
						<!-- end .media-body -->
					</div>
					<!-- end .media -->

					<form action="#" method="POST" role="form">
						<div class="form-group">
							<textarea name="reply-{{ $status->user->id }}" class="form-control" placeholder="Reply to this status..." rows="1"></textarea>
						</div>

						<button class="btn btn-default btn-sm mb-3" type="submit">Reply</button>
					</form>

				@endforeach

				{{ $statuses->render() }}
			@endif
		</div>
	</div>
@endsection
