@extends('layouts.layout')

@section('title')
    CP - Contact Admin
@stop

@section('body-id')
    id="home"
@stop

@section('content')
  <div class="col-md-6 offset-md-3">
    <div class="topbar @if($user->type == 'boat') boatsTopbar @endif">
      <a href="{{ route('editprofile') }}"><h5>Back to Edit My Profile</h5></a>
    </div>
    <div class="card border-primary">
      <div class="card-body">
        <blockquote class="card-blockquote">
          <h4>Message To: <b>Crew Point Administrator</b></h4>
          <div class="card">
            <div class="card-body">
              <form action="{{ route('messages.store') }}" method="POST">
                {{ method_field('POST') }}
                {{ csrf_field() }}
                <input name="id" type="hidden" value="{{ $recom->id }}">
                <input name="to" type="hidden" value="admin">
                <div class="form-group">
                  <h5>REQUEST to remove recommendation received from {{ $recom->username }}
                    on {{ $recom->created_at->format('j M Y') }}</h5>
                </div>
                <div class="form-group">
                  <textarea name="message" class="form-control" rows="5" placeholder="Please provide your reasons for request" required>{{ old('message') }}</textarea>
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
