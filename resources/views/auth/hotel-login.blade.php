@extends('layouts.auth')

@section('title')
	Hotel
@endsection

@section('content')


	<section class="login">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-push-3">
					<div class="complete-box">
						<div class="panel1">
							<div class="log-img">
								<img src="{{ URL::to('src/images/login.png') }}">
							</div>
							<div class="l-panel">
								<h4>LOGIN PANEL</h4>
							</div>
						</div>

						<form class="signin" method="post" action="{{ route('hotel.login.submit') }}">
							<div class="log-box">

								<div class="log {{ $errors->has('email') ? ' has-error' : '' }}">
									<input class="email1" type="email" placeholder="Email" name="email" required>
									@if ($errors->has('email'))
										<span class="help-block">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif

									<input class="email1" type="password" placeholder="Password" name="password" required>
								</div>
								<div class="remember-pass">
									<div class="remember">
										<input class="check" type="checkbox" checked="checked"> Remember me
									</div>
									<div class="fg-pass">
										<div>
											<span class="psw">Forgot password?</span>

											<a href="{{ route('password.request') }}"><strong>Click Here</strong></a>
										</div>
									</div>
								</div>
								<button class="btn btn-danger butn1" type="submit">LOG IN</button>
								{{ csrf_field() }}
								<p class="power">Powered by <strong>KIBAK-IT-TRAVEL</strong></p>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</section>


	{{--<div class="container">--}}
	{{--<div class="row">--}}
	{{--<div class="col-md-8 col-md-offset-2">--}}
	{{--<div class="panel panel-default">--}}
	{{--<div class="panel-heading">ADMIN Login</div>--}}
	{{--<div class="panel-body">--}}
	{{--<form class="form-horizontal" role="form" method="POST" action="{{ route('admin.login.submit') }}">--}}
	{{--{{ csrf_field() }}--}}

	{{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
	{{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

	{{--<div class="col-md-6">--}}
	{{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>--}}

	{{--@if ($errors->has('email'))--}}
	{{--<span class="help-block">--}}
	{{--<strong>{{ $errors->first('email') }}</strong>--}}
	{{--</span>--}}
	{{--@endif--}}
	{{--</div>--}}
	{{--</div>--}}

	{{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
	{{--<label for="password" class="col-md-4 control-label">Password</label>--}}

	{{--<div class="col-md-6">--}}
	{{--<input id="password" type="password" class="form-control" name="password" required>--}}

	{{--@if ($errors->has('password'))--}}
	{{--<span class="help-block">--}}
	{{--<strong>{{ $errors->first('password') }}</strong>--}}
	{{--</span>--}}
	{{--@endif--}}
	{{--</div>--}}
	{{--</div>--}}

	{{--<div class="form-group">--}}
	{{--<div class="col-md-6 col-md-offset-4">--}}
	{{--<div class="checkbox">--}}
	{{--<label>--}}
	{{--<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me--}}
	{{--</label>--}}
	{{--</div>--}}
	{{--</div>--}}
	{{--</div>--}}

	{{--<div class="form-group">--}}
	{{--<div class="col-md-8 col-md-offset-4">--}}
	{{--<button type="submit" class="btn btn-primary">--}}
	{{--Login--}}
	{{--</button>--}}

	{{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
	{{--Forgot Your Password?--}}
	{{--</a>--}}
	{{--</div>--}}
	{{--</div>--}}
	{{--</form>--}}
	{{--</div>--}}
	{{--</div>--}}
	{{--</div>--}}
	{{--</div>--}}
	{{--</div>--}}
@endsection