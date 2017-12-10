@extends('layouts.layout')

@section('title')
    {{ config('app.name') }}
@stop

@section('body-id')
    id="home"
@stop

@section('content')
<div class="jumbotron col-lg-4 offset-lg-4 col-sm-8 offset-sm-2">
  <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
      {{ csrf_field() }}
      
      <input type="hidden" name="token" value="{{ $token }}">

      <legend>Reset Password</legend>

      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="Email address" required autofocus>
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

      <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
        @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Reset Password</button>
      </div>
  </form>
</div>

@endsection
