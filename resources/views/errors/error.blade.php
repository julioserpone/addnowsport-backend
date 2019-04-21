@extends('layouts.public')

@section('content')

<div class="container">

	<div class="page-not-found">

		<h1>¡Ups, lo sentimos!</h1>
		<h2>Lamentablemente su solicitud no ha podido ser procesada.</h2>

		{{ HTML::image('images/logo-disabled.png', 'KairosNow Play') }}

	</div>
</div>

@stop