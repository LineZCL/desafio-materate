@extends('layouts.app')

@section('content')
<div class="container">
	<form action="/user/save", method="post">
		<form action="/login", method="post">
			{{ csrf_field() }}
			<input id="id" type="hidden" name="id" value="{{$user->id}}" >
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<label for="name">Name</label>
			<input id="name" type="text" name="name" value="{{$user->name}}" >
			<br/>
			<label for="email">Email</label>
			<input id="email" type="text" name="email" value="{{$user->email}}" >
			<br/>
			<label for="role_id" class="col-md-4 control-label">Role</label>
			<select id="role_id" name = "role_id">
				@foreach($roles as $role)
				<option value="{{$role->id}}">{{$role->description}}</option>
				@endforeach
			</select>
			<br/>
			<button type="submit" class="btn btn-primary">
				Save
			</button>

		</form>
	</div>
	@endsection
