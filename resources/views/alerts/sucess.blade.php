@if(Session::has('message'))
	<div class="alert alert-success background-success m-b-20">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<i class="icofont icofont-close-line-circled text-white"></i>
		</button>
		{{Session::get('message')}}
	</div>
@endif