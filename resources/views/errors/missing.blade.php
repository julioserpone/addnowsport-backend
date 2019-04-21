@extends('layouts.public')

@section('content')

<div class="container">

	<div class="page-not-found">

		<h1>¡Ups, lo sentimos!</h1>
		<h2>Creo que has tomado una ruta que ya no existe, regresa por donde venías o bien busca una ruta nueva.</h2>

		{{ HTML::image('images/logo-disabled.png', 'KairosNow Play') }}

	</div>
</div>

@stop