@if (Session::has('error'))
	<div class="alert alert-danger" role="alert">
		<strong>Oops:</strong> {{ Session::get('error') }}
	</div>
@elseif (Session::has('success'))
	<div class="alert alert-success" role="alert">
		<strong>Success:</strong> {{ Session::get('success') }}
	</div>

@endif


<!--check automatic form errors-->
@if (count($errors)>0)
	<div class="alert alert-danger" role="alert">
		<strong>Errors:</strong>
		<ul>
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
		</ul> 
	</div>
@endif