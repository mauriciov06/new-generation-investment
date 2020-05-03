@if(count($errors) > 0)
	<div class="alert alert-danger background-danger m-b-20">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<i class="icofont icofont-close-line-circled text-white"></i>
		</button>
		<ul>
			@foreach($errors->all() as $error)
			<li>{!!$error!!}</li>
			@endforeach
		</ul>
	</div>	
@endif