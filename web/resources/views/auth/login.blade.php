@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form action="/login", method="post">
                        {{ csrf_field() }}
                        @if(session()->has('error'))
                            <div class="alert alert-danger">
                                <strong>{{session('error')}}</strong> 
                            </div>
                        @endif;
                        
                        <div>
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6" style="margin-bottom: 10px;">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>
                        <br/>
                        <div>
                            <label for="password" class="col-md-4 control-label;">Password</label>

                            <div class="col-md-6" style="margin-bottom: 10px;">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
