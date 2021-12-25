@extends('layouts.main')

@section('content')
	<section class="agent-data">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="home-img">
						<img src="{{ URL::to('src/images/img1.jpg') }}">
					</div>
				</div>
				<div class="col-md-6">
					<div class="home-img2">
						<img src="{{ URL::to('src/images/img1.jpg') }}">
					</div>
					<div class="home-img3">
						<img src="{{ URL::to('src/images/img1.jpg') }}">
					</div>
				</div>
			</div>
		</div>
	</section>
	<section>
		<div class="container">
			<div class="flash">
				<div class="deal-wrap">
					<div class="row">
						<div class="col-md-6">
							<h1 class="deal">Flash Deals</h1>
						</div>
						<div class="col-md-6">
							<div class="v-more">
								<p>View More<span><i class="fa fa-angle-right"></i></span></p>
							</div>
						</div>
					</div>
				</div>
				<div class="owl-carousel owl-theme" id="slide1">
					<div class="item">
						<img src="{{ URL::to('src/images/img.jpg') }}">
					</div>
					<div class="item">
						<img src="{{ URL::to('src/images/img2.jpg') }}">
					</div>
					<div class="item">
						<img src="{{ URL::to('src/images/img.jpg') }}">
					</div>
					<div class="item">
						<img src="{{ URL::to('src/images/img2.jpg') }}">
					</div>
					<div class="item">
						<img src="{{ URL::to('src/images/img.jpg') }}">
					</div>
					<div class="item">
						<img src="{{ URL::to('src/images/img2.jpg') }}">
					</div>
				</div>
			</div>
			<!-- Carousel -->

		</div>
	</section>
@endsection