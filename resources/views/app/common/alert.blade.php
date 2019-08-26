@if (Session::has('success'))
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>Success!</strong> {{ Session::get('success') }}
	</div>
@elseif (Session::has('error'))
	<div class="alert alert-error alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>Error!</strong> {{ Session::get('error') }}
	</div>
@endif

@if(!$errors->isEmpty())
  <div class="alert alert-error alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>Error!</strong> {{ $errors->first() }}
	</div>
@endif

