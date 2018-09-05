@extends('layouts.main')

@section('title')
	HomePage
@endsection

@section('content')
	<div class="row">
		<div class="col-lg-6">
			<form action="POST" method="#" role="form">
				<div class="form-group">
					<textarea placeholder="What's up <name>?'" name="status" rows="2" class="form-control"></textarea>
				</div>
				<button class="btn btn-primary">Update</button>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-5">
			<!-- timeline updates -->
		</div>
	</div>
@endsection
