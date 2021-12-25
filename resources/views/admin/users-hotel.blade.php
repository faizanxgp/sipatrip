@extends('layouts.main')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				You are logged in as <strong>ADMIN</strong>
				<h2>Hotel Users</h2>
				<table class="table table-striped">
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Website</th>
						<th>Approved</th>
						<th>Created</th>
						<th>Action</th>
					</tr>
					@foreach ($users as $user)
						<tr>
							<td>{{ $user->first_name }} {{ $user->last_name }}</td>
							<td>{{ $user->email }}</td>
							<td>{{ $user->phone }}</td>
							<td>{{ $user->website }}</td>
							<td>@if ($user->approved == 0) No @else Yes @endif</td>
							<td>{{ $user->created_at }}</td>
							<td><a href="{{ route('admin.user.hotel', $user->id) }}" class="btn btn-primary">@if ($user->approved == 0) Approve @else Suspend @endif</a></td>
						</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
@endsection