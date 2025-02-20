@extends('layouts.app')

@section('content')
<div class="col-sm-12 d-flex flex-column align-items-center justify-content-center">
<?php
// if (request()->session()->missing('users')) {
// 	request()->session()->put('users', \Auth::user());
// }
// dd(request()->session()->all(), \Auth::user())
// request()->session()->flush();
?>
	<h3>Dashboard</h3>
	<p class="text-gray text-center">You're logged in!</p>

</div>
@endsection

@section('js')
@endsection
