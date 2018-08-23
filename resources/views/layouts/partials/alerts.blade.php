@if (Session::has('info'))
	<div class="alert alert-info" role="alert">
		{{ Session::get('info') }}
	</div>
@elseif (Session::has('danger'))
	<div class="alert alert-danger" role="alert">
		{{ Session::get('danger') }}
	</div>
@elseif (Session::has('success'))
	<div class="alert alert-success" role="alert">
		{{ Session::get('success') }}
	</div>
@endif
