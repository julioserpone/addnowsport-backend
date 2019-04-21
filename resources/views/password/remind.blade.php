@extends('layouts.public')

@section('content-class') content-float @stop

@section('content')

<div class="container top-login">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h3 class="page-header invert text-center">Recuperar contraseña</h3>
		</div>
		<br>
		<div class="col-md-6 col-md-offset-3">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">
					Escriba su email
				</div>

				<div class="panel-body">

					@if(Session::has('error'))
					<div class="alert alert-danger">
						{{ Session::get('error') }}
					</div>
					@endif

					@if(Session::has('status'))
					<div class="alert alert-info">
						{{ Session::get('status') }}
					</div>
					@endif

					{{ Form::open(array('url' => 'password/remind', 'role' => 'form')) }}
					<fieldset>
						<div class="form-group">
							{{ Form::text('email', Input::old('email'), array('class' => 'form-control', 'autofocus' => 'autofocus')) }}
							{{ $errors->first('email') }}
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

@section('scripts_footer')
	@parent
	{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js') }}
	<script type="text/javascript" >
		$(function(){
			$.backstretch && $.backstretch("images/bg_login.jpg");
		});
	</script>
@stop