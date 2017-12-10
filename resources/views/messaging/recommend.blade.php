@extends('layouts.layout')

@section('title')
    CP - Recommend
@stop

@if($user->type == 'boat')
  @section('body-id')
      id="boats"
  @stop
@endif

@section('content')
  <div class="col-md-6 offset-md-3">
    <div class="topbar @if($user->type == 'boat') boatsTopbar @endif">
      <a href="{{ route('profile.show', $user->id) }}"><h5>Back to {{ $user->username }}'s profile</h5></a>
    </div>
    <div class="card border-primary">
      <div class="card-body">
        <blockquote class="card-blockquote">
          <h4>Recommendation For: <b>{{ $user->username }}</b></h4>
          <div class="card">
            <div class="card-body">
              <form action="{{ route('recommendation.store') }}" method="POST">
                {{ method_field('POST') }}
                {{ csrf_field() }}
                <input name="id" type="hidden" value="{{ $user->id }}">
                <div class="form-group">
                  <textarea name="recom" class="form-control" rows="5" placeholder="Your recommendation" required></textarea>
                </div>
                <button class="btn btn-outline-primary" type="submit" name="button">Submit Recommendation</button>
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
