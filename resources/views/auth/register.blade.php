@extends('layouts.auth')

@section('title')
	Agent
@endsection

@section('content')

	<section class="login">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="panel1">
						<div class="log-img">
							<img src="images/Sign Up.png">
						</div>
						<div class="join">
							<h4>JOIN US</h4>
						</div>
						@if(Session::has('flash_message'))
							<div class="alert alert-success">
								{{ Session::get('flash_message') }}
							</div>
						@endif

					</div>
					<div class="inner-data">
						<div class="top-heading">
							<h2>ACCOUNT PROFILE</h2>
							<i class="fa fa-warning"></i><span>Please enter all details in English. The highlighted fields are required</span>
						</div>
						<h3>Agency Details</h3>
						<form class="agency-form" method="post" action="{{ route('register') }}">
							<div class="row">
								<div class="col-md-2">
									<label><b>First Name <span class="required">*</span></b></label>
								</div>
								<div class="col-md-4  {{ $errors->has('first_name') ? ' has-error' : '' }}">
									<input type="text" name="first_name" value="{{ old('first_name') }}" required>
									@if ($errors->has('first_name'))
										<p class="help-block">
											<strong>{{ $errors->first('first_name') }}</strong>
										</p>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-md-2">
									<label><b>Last Name <span class="required">*</span></b></label>
								</div>
								<div class="col-md-4 {{ $errors->has('last_name') ? ' has-error' : '' }}">
									<input type="text" name="last_name" value="{{ old('last_name') }}"  required>
									@if ($errors->has('last_name'))
										<p class="help-block">
											<strong>{{ $errors->first('last_name') }}</strong>
										</p>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-md-2">
									<label><b>Email <span class="required">*</span></b></label>
								</div>
								<div class="col-md-4 {{ $errors->has('email') ? ' has-error' : '' }}">
									<input type="email" name="email" value="{{ old('email') }}"  required>
									@if ($errors->has('email'))
										<p class="help-block">
											<strong>{{ $errors->first('email') }}</strong>
										</p>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-md-2">
									<label><b>Phone no</b></label>
								</div>
								<div class="col-md-4 {{ $errors->has('phone') ? ' has-error' : '' }}">
									<input type="text" name="phone" value="{{ old('phone') }}" >
									@if ($errors->has('phone'))
										<p class="help-block">
											<strong>{{ $errors->first('phone') }}</strong>
										</p>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-md-2">
									<label><b>Password <span class="required">*</span></b></label>
								</div>
								<div class="col-md-4 {{ $errors->has('password') ? ' has-error' : '' }}">
									<input type="password" name="password" required>
									@if ($errors->has('password'))
										<p class="help-block">
											<strong>{{ $errors->first('password') }}</strong>
										</p>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-md-2">
									<label><b>Password Confirmation <span class="required">*</span></b></label>
								</div>
								<div class="col-md-4 {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
									<input type="password" name="password_confirmation" required>
									@if ($errors->has('password_confirmation'))
										<p class="help-block">
											<strong>{{ $errors->first('password_confirmation') }}</strong>
										</p>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-md-2">
									<label><b>Website Link</b></label>
								</div>
								<div class="col-md-4 {{ $errors->has('website') ? ' has-error' : '' }}">
									<input type="text" name="website" value="{{ old('website') }}"  >
									@if ($errors->has('website'))
										<p class="help-block">
											<strong>{{ $errors->first('website') }}</strong>
										</p>
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-md-1 col-xs-1 {{ $errors->has('agree') ? ' has-error' : '' }}">
									<input name="agree" class="checkbox" type="checkbox" checked="">

								</div>
								<div class="col-md-5 col-xs-10">
									<p class="terms"> You must agree to our Terms and Conditions</p>
								</div>
							</div>
							<div class="clearfix">
								<button class="btn btn-danger rb" type="submit" class="cancelbtn">Join Now</button>
								{{ csrf_field() }}
							</div>
							<div class="clearfix1">
								<div class="row">
									<div class="col-md-2">
										<p>Sign Up Using: </p>
									</div>
									<div class="col-md-2">
										<a href="#"><button class="btn btn-danger google-rb"><i class="fa fa-google-plus "></i></button></a>
									</div>
									<div class="col-md-2">
										<a href="#"><button class="btn btn-danger fb-rb"><i class="fa fa-facebook"></i></button></a>
									</div>
								</div>
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
                {{--<div class="panel-heading">Register</div>--}}

                {{--<div class="panel-body">--}}
                    {{--<form class="form-horizontal" method="POST" action="{{ route('register') }}">--}}
                        {{--{{ csrf_field() }}--}}

                        {{--<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">--}}
                            {{--<label for="name" class="col-md-4 control-label">Name</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>--}}

                                {{--@if ($errors->has('name'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('name') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                            {{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>--}}

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
                            {{--<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--Register--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
@endsection
