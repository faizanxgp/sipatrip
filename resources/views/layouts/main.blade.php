<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ URL::to('src/assets/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/assets/owlcarousel/assets/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/assets/owlcarousel/assets/owl.theme.default.min.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/assets/fontawesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ URL::to('src/css/main.css') }}">

</head>
<body>
<header>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="navbar1">
					<div class="top-nav">
					</div>
					<nav class="navbar navbar-default">
						<div class="container">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
									<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
								</button>
								<h2 class="dash">DASHBOARD</h2>
							</div>
						@if (Auth::user()->type() == 'Agent')
							<!-- Collect the nav links, forms, and other content for toggling -->
								<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
									<ul class="nav navbar-nav nav-items">
										<li><a href="#">FLIGHTS</a></li>
										<li><a href="#">HOTELS</a></li>
									</ul>
									<ul class="nav navbar-nav navbar-right">
										<li><p>Welcome @if (isset(Auth::user()->id)) {{ Auth::user()->name() }} @endif</p></li>
										<li>{USD: 0.00}</li>
										<li><img class="profile-pic" src="{{ URL::to('src/images/Pic.png') }}"></li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-icon"></i><span class="caret"></span></a>
											<ul class="dropdown-menu">
												<li><a href="#">Settings</a></li>
												<li><a href="{{ route('logout') }}">Logout</a></li>
											</ul>
										</li>
									</ul>
								</div><!-- /.navbar-collapse -->
						@elseif ( Auth::user()->type() == 'Hotel')
							<!-- Collect the nav links, forms, and other content for toggling -->
								<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
									<ul class="nav navbar-nav nav-items">
										<li><a href="#">FLIGHTS</a></li>
										<li><a href="#">HOTELS</a></li>
									</ul>
									<ul class="nav navbar-nav navbar-right">
										<li><p>Welcome @if (isset(Auth::user()->id)) {{ Auth::user()->name() }} @endif</p></li>
										<li>{USD: 0.00}</li>
										<li><img class="profile-pic" src="{{ URL::to('src/images/Pic.png') }}"></li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-icon"></i><span class="caret"></span></a>
											<ul class="dropdown-menu">
												<li><a href="#">Settings</a></li>
												<li><a href="{{ route('hotel.logout') }}">Logout</a></li>
											</ul>
										</li>
									</ul>
								</div><!-- /.navbar-collapse -->

						@elseif ( Auth::user()->type() == 'Airline')
							<!-- Collect the nav links, forms, and other content for toggling -->
								<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
									<ul class="nav navbar-nav nav-items">
										<li><a href="#">FLIGHTS</a></li>
										<li><a href="#">HOTELS</a></li>
									</ul>
									<ul class="nav navbar-nav navbar-right">
										<li><p>Welcome @if (isset(Auth::user()->id)) {{ Auth::user()->name() }} @endif</p></li>
										<li>{USD: 0.00}</li>
										<li><img class="profile-pic" src="{{ URL::to('src/images/Pic.png') }}"></li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-icon"></i><span class="caret"></span></a>
											<ul class="dropdown-menu">
												<li><a href="#">Settings</a></li>
												<li><a href="{{ route('airline.logout') }}">Logout</a></li>
											</ul>
										</li>
									</ul>
								</div><!-- /.navbar-collapse -->
							@else
							<!-- Collect the nav links, forms, and other content for toggling -->
								<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
									<ul class="nav navbar-nav nav-items">
										<li><a href="{{ route('admin.dashboard')  }}">HOME</a></li>
										<li><a href="#">FLIGHTS</a></li>
										<li><a href="#">HOTELS</a></li>
										<li><a href="{{ route('admin.users.agent')  }}">AGENTS</a></li>
										<li><a href="{{ route('admin.users.hotel')  }}">HOTELS</a></li>
										<li><a href="{{ route('admin.users.airline')  }}">AIRLINES</a></li>
									</ul>
									<ul class="nav navbar-nav navbar-right">
										<li><p>Welcome @if (isset(Auth::user()->id)) {{ Auth::user()->name() }} @endif</p></li>
										<li>{USD: 0.00}</li>
										<li><img class="profile-pic" src="{{ URL::to('src/images/Pic.png') }}"></li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-icon"></i><span class="caret"></span></a>
											<ul class="dropdown-menu">
												<li><a href="#">Settings</a></li>
												<li><a href="{{ route('admin.logout') }}">Logout</a></li>
											</ul>
										</li>
									</ul>
								</div><!-- /.navbar-collapse -->
							@endif
						</div><!-- /.container-fluid -->
					</nav>
				</div>
			</div>
		</div>
	</div>
</header>
<section>
	@yield('content')
</section>

<footer>
	<div class="f-bg">
	</div>
</footer>

<script src="{{ URL::to('src/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ URL::to('src/jquery.min.js') }}"></script>
<script src="{{ URL::to('src/assets/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
// <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
// <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script> -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Include all compiled plugins (below), or include individual files as needed -->

<script src="{{ URL::to('src/assets/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ URL::to('src/js/main.js') }}"></script>

</body>
</html>