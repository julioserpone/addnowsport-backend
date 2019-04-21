@extends('layouts.public')

@section('content')

<div class="container">

	<h3 class="page-header">Definir contraseña</h3>

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
		<div class="login-panel panel panel-default">
			<div class="panel-heading">
				Ingrese sus datos
			</div>
			<div class="panel-body">

				@if(isset($error))
				<div class="alert alert-danger">
					{{ $error }}
				</div>
				@endif

				@if(isset($status))
				<div class="alert alert-info">
					{{ $status }}
				</div>
				@endif

				{{ Form::open(array('url' => 'password/reset', 'role' => 'form')) }}
				{{ Form::hidden('token', $token) }}
				<fieldset>
				<div class="form-group">
					{{ Form::label('email', 'Email') }}
					{{ Form::text('email', Input::old('email'), array('class' => 'form-control', 'autofocus' => 'autofocus')) }}
					{{ $errors->first('email') }}
				</div>

				<div class="form-group">
					{{ Form::label('password', 'Contraseña') }}
					{{ Form::password('password', array('class' => 'form-control')) }}
					{{ $errors->first('password') }}
				</div>

				<div class="form-group">
					{{ Form::label('password_confirmation', 'Confirmar contraseña') }}
					{{ Form::password('password_confirmation', array('class' => 'form-control')) }}
					{{ $errors->first('password_confirmation') }}
				</div>

				<div class="form-group clearfix">
					<div class="pull-right">
						{{ Form::submit('Enviar', array('class' => 'btn btn-lg btn-success btn-sm')) }}
					</div>
				</div>

				</fieldset>
				{{ Form::close() }}
			</div>
			</div>
		</div>
	</div>
</div>

@stop