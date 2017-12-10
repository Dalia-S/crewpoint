@extends('layouts.layout')

@section('title')
    CP - Login
@stop

@section('body-id')
    id="home"
@stop

@section('content')
  <div class="jumbotron col-lg-4 offset-lg-4 col-sm-8 offset-sm-2">
    <form method="POST" action="{{ route('login') }}">
      {{ csrf_field() }}
      <fieldset>
        <legend>Login</legend>
        <p class="form-text text-muted">Not registered yet? <a href="{{ route('register')}}">Click here</a>.</p>
        <h5>Please enter your details</h5>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email address" required autofocus>
          @if ($errors->has('email'))
              <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
          @if ($errors->has('password'))
              <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
          <a class="form-text text-muted" href="{{ route('password.request') }}">Forgot Your Password?</a>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Log In</button>
        </div>
      <fieldset>
    </form>
  </div>
@endsection
