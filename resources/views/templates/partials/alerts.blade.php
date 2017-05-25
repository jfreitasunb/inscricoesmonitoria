@if(Session::has('info'))
	<div class="alert alert-info" role="alert">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		{{ Session::get('info')}}
	</div>
@endif

@if(Session::has('success'))
	<div class="alert alert-success" role="alert">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		{{ Session::get('success')}}
	</div>
@endif

@if(Session::has('erro'))
	<div class="alert alert-danger" role="alert">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		{{ Session::get('erro')}}
	</div>
@endif

@if (count($errors) > 0)
	<div class="alert alert-danger" role="alert">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<ul>
			@foreach ($errors->all() as $error)
				<li> {{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif