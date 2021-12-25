@extends('layouts.main')

@section('content')
	<section class="agent-data">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<form method="post" action="{{ route('user.hotels.search') }}">

						<label>Destination</label> <select name="destination" class="form-control"></select>

						<label>From Date</label> <input type="date" name="fromdate" class="form-control"/>

						<label>Upto Date</label> <input type="date" name="uptodate" class="form-control"/>

						<label>Rooms</label>
						<div class="row">
							<div class="col-md-6">Adult: <input type="number" min="1" max="10" name="adults" value="1" class="form-control"/></div>
							<div class="col-md-6">Child: <input type="number" min="0" max="10" name="children" value="0" class="form-control"/></div>
						</div>

						<input type="submit" name="submit" value="Proceed"/>
						{{ csrf_field() }}

					</form>
				</div>
				<div class="col-md-9">


					<h2>{{ $property->PropertyName }} {{ $property->Rating }}</h2>
					<p>{{ $property->Address1 }} {{ $property->TownCity }} {{ $property->Country }}</p>
					<div class="row" style="min-height: 50px; background-color: #eee;">
						<div class="col-md-6">Images
						<img src="{{ $property->CMSBaseURL . $property->MainImage }}" alt="" />

						</div>
						<div class="col-md-6">Map</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<?php

							$string = $property->Description;
							$string = str_replace(array('\r\n', '\r', '\n'), "<br />", $string);

							?>


							{!! $string !!}


						</div>
					</div>
					<div class="row">

						<div class="col-md-3" style="background-color: #eee; min-height: 70px;"><strong>Room Type</strong><br />Room 1, 2 Adults</div>
						<div class="col-md-2" style="background-color: #eee; min-height: 70px;">Options</div>
						<div class="col-md-3" style="background-color: #eee; min-height: 70px;">Conditions</div>
						<div class="col-md-2" style="background-color: #eee; min-height: 70px;">Price</div>
						<div class="col-md-2" style="background-color: #eee; min-height: 70px;"></div>
					</div>

					@foreach($property->PropertyRoomTypes->PropertyRoomType as $roomType)
						<div class="row" style="margin-bottom: 10px; border-bottom: 1px solid #eee;">
							<div class="col-md-3">{{ $roomType->RoomType }}</div>
							<div class="col-md-2">{{ $roomType->DefaultMealBasis }}</div>
							<div class="col-md-3"></div>
							<div class="col-md-2"></div>
							<div class="col-md-2"><a href="" class="btn btn-danger">Book</a></div>
						</div>
					@endforeach
				</div>


			</div>


		</div>


	</section>
@endsection