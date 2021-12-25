@extends('layouts.main')

@section('content')
	<section class="search-data">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<form method="post" action="{{ route('user.hotels.search') }}">

						<label>Destination</label> <select name="destination" class="form-control">
							<option value="72">Belgium|Brussels</option>
							<option value="616">Thailand|Bangkok</option>
							<option value="2773">Egypt|Sharm El Sheikh</option>



						</select>

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


					@if(isset($properties))





						@foreach($properties->PropertyResult as $property)


							<div class="row">

								<div class="col-md-3">
									img
								</div>
								<div class="col-md-6">
									<p>{{ $property->Rating }}</p>
									<p><a href="{{ route('user.hotel.details', $property->PropertyID ) }}">{{ $property->PropertyName }}</a></p>
									<p>View Map</p>
									<p>{{ $property->Region }} {{ $property->Country }}</p>
								</div>
								<div class="col-md-3">
									USD {{ $property->RoomTypes->RoomType[0]->Total }}<br /><br />
									<a href="{{ route('user.hotel.details', $property->PropertyID ) }}" class="btn btn-danger">Details</a>
								</div>
								<div class="col-md-12">
									<hr/>
								</div>

							</div>
						@endforeach
				</div>
				@else

					nothing here

				@endif


			</div>
		</div>
		</div>
	</section>
@endsection
