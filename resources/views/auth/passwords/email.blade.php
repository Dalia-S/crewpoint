@extends('layouts.layout')

@section('title')
    {{ config('app.name') }}
@stop

@section('body-id')
    id="home"
@stop

@section('content')
  <div class="jumbotron col-lg-4 offset-lg-4 col-sm-8 offset-sm-2">
    <legend>Reset Password</legend>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email address" required>
          @if ($errors->has('email'))
              <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif
        </div>
        <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
    </form>
  </div>
@endsection
