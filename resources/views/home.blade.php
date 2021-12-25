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
@endsection
