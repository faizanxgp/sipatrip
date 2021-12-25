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
				<div class="logo">
					<img src="{{ URL::to('src/images/logo.png') }}">
					<h2 class="black">User: @yield('title')</h2>
				</div>
			</div>
		</div>
	</div>
</header>

@yield('content')

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