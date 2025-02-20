@extends('layouts.app')

@section('content')

	<div class="col-sm-8 text-center tw">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Error 404 : Page Not Found') }}
		</h2>
	</div>

	<div class="col-sm-8 flex justify-content-center" >
		<a href="{{ url('/dashboard') }}" class="">
			<img src="{{ asset('images/errors/404-error.jpg') }}" class="img-fluid rounded " alt="">
		</a>
	</div>

@endsection
