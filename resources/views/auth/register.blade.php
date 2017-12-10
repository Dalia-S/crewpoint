@extends('layouts.layout')

@section('title')
    CP - Register
@stop

@section('body-id')
    id="home"
@stop

@section('content')
  <div class="jumbotron col-md-4 offset-md-4">
    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
      <fieldset>
        <legend>Registration</legend>
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
          <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username / Boat Name" required autofocus>
          <p class="form-text text-muted">How you will appear to other users</p>
          @if ($errors->has('username'))
              <span class="help-block">
                  <strong>{{ $errors->first('username') }}</strong>
              </span>
          @endif
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email address" required>
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
        </div>

        <div class="form-group">
          <input id="password-confirm"  type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
        </div>

        <fieldset class="form-group{{ $errors->has('profileType') ? ' has-error' : '' }}">
          <h5><b>Select one:</b></h5>
          <div class="form-check">
            <label class="form-check-label">
              <input id="crewProfile" type="radio" class="form-check-input radio-button" name="profileType" value="crew" required>
              Crew profile
            </label>
          </div>
          <div class="form-check">
          <label class="form-check-label">
              <input id="boatProfile" type="radio" class="form-check-input radio-button" name="profileType" value="boat">
              Boat profile
            </label>
          </div>
          @if ($errors->has('profileType'))
              <span class="help-block">
                  <strong>{{ $errors->first('profileType') }}</strong>
              </span>
          @endif
        </fieldset>

        <div class="form-group">
          <button type="submit" class="btn btn-primary">Register</button>
        </div>
      <fieldset>
    </form>
  </div>
@endsection
