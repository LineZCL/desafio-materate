@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-body">
					<form action="/user/save", method="post">
						<form action="/login", method="post">
							{{ csrf_field() }}
							<input id="id" type="hidden" name="id" value="{{$user->id}}" >
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label for="name" class="col-md-4 control-label">Name</label>
								<input id="name" type="text" name="name" value="{{$user->name}}"  class="form-control">
							</div>
							<div class="form-group">
								<label for="email" class="col-md-4 control-label">Email</label>
								<input id="email" type="text" name="email" value="{{$user->email}}" class="form-control" >
							</div>
							<div class="form-group">
								<label for="role_id" class="col-md-4 control-label">Role</label>
								<select id="role_id" name = "role_id" class="form-control">
									@foreach($roles as $role)
									<option value="{{$role->id}}"  @if($user->role_id == $role->id) selected @endif>{{$role->description}}</option>
									@endforeach
								</select>
							</div>
							<div style = "float: right">
								<a class="btn btn-primary" href="/" role="button">Voltar</a>
								<button type="submit" class="btn btn-primary">
									Save
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection
