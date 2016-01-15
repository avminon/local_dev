@extends('app')

@section('title')
{{ $user->name }}

@endsection

@section('content')
<div>
	<ul class="list-group">
		<li class="list-group-item">
			Joined on {{$user->created_at->format('M d,Y \a\t h:i a') }}
		</li>
		<li class="list-group-item panel-body">
			<table class="table-padding">
				<tr><td><a href='change-name'>Change Name</a></td></tr>
				<tr><td><a href='change-password'>Change Password</a></td></tr>
			</table>
		</li>
	</ul>
</div>

@endsection
