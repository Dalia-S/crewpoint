@extends('layouts.layout')

@section('title')
    CP - Send Message
@stop

@if($user->type == 'boat')
  @section('body-id')
      id="boats"
  @stop
@endif

@section('content')
  <div class="col-md-6 offset-md-3">
    <div class="topbar @if($user->type == 'boat') boatsTopbar @endif">
      @empty($backTo)
        <a href="{{ route('profile.show', $user->id) }}"><h5>Back to {{ $user->username }}'s profile</h5></a>
      @endempty
      @if(isset($backTo) && $backTo == 'backtomessages')
        <a href="{{ route('messages.index') }}"><h5>Back to My Messages</h5></a>
      @endif
    </div>
    <div class="card border-primary">
      <div class="card-body">
        <blockquote class="card-blockquote">
          <h4>Message To: <b>{{ $user->username}}</b></h4>
          <div class="card">
            <div class="card-body">
              <form action="{{ route('messages.store') }}" method="POST">
                {{ method_field('POST') }}
                {{ csrf_field() }}
                <input name="id" type="hidden" value="{{ $user->id }}">
                <div class="form-group">
                  <input name="subject" type="text" class="form-control" placeholder="Subject" value="{{ old('subject') }}">
                  @if($errors->has('subject'))
                      <span class="help-block">
                          <strong>{{ $errors->first('subject') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group">
                  <textarea name="message" class="form-control" rows="5" placeholder="Your message" required>{{ old('message') }}</textarea>
                  @if($errors->has('message'))
                      <span class="help-block">
                          <strong>{{ $errors->first('message') }}</strong>
                      </span>
                  @endif
                </div>
                <button class="btn btn-outline-primary" type="submit" name="button">Send Message</button>
              </form>
              @if(Session::has('message'))
                <p class="alert alert-success">{{ session('message') }}</p>
              @endif
            </div>
          </div>
        </blockquote>
      </div>
    </div>
  </div>
@stop
