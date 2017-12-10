@extends('layouts.layout')

@section('title')
    CP - Profile
@stop

@if($user->type == 'boat')
  @section('body-id')
      id="boats"
  @stop
@endif

@section('topbar')
  <div class="topbar @if($user->type == 'boat') boatsTopbar @endif">
    @unless($myprofile)
      <a href="#contact"><h5>Contact {{ $user->username }}</h5></a>
    @endunless
    <a href="#log"><h5>Sailing Log</h5></a>
    @if(sizeof($recommendations)!=0)
      <a href="#recommendations"><h5>Recommendations</h5></a>
    @endif
  </div>
@stop

@section('sidebar')
    <div class="col-md-3 sidebar">
      <div class="card border-primary ">
        <div class="card-body">
          <blockquote class="card-blockquote">
            <h4><b>{{ $user->username }}</b></h4>
            @if($myprofile)
              <div class="addLinks">
                <a href="{{ route('editprofile') }}">Edit Profile</a>
                <a href="{{ route('messages.index') }}">Messages
                  @if(!empty($msg))
                    <span>{{ $msg }} new</span>
                  @endif
                </a>
              </div>
            @endif
            @if(empty($profile['photo']) && $user->type == 'crew')
              <img src="{{ URL::asset('img/crewprofile.png') }}" alt="profile photo" />
            @endif
            @if(empty($profile['photo']) && $user->type == 'boat')
              <img src="{{ URL::asset('img/boatprofile.jpg') }}" alt="profile photo" />
            @endif
            @unless(empty($profile['photo']))
              <img src="{{ URL::asset('storage/photos/'.$profile['photo'].'') }}" alt="profile photo" />
            @endunless
            {{-- Crew profile --}}
            @unless(empty($user->name))
              <p class="text-muted">Name:</p>
              <p>{{ $user->name }}</p>
            @endunless
            @unless(empty($profile['age']))
              <p class="text-muted">Age:</p>
              <p>{{ $profile['age'] }}</p>
              @endunless
            @unless(empty($profile['location']) || $user->type == 'boat')
              <p class="text-muted">Location:</p>
              <p>{{ $profile['location'] }}</p>
              @endunless
            @unless(empty($profile['qualification']))
              <p class="text-muted">Qualification:</p>
              <p>{{ $profile['qualification'] }}</p>
            @endunless
            @if(!empty($milesTotal) && !empty($profile['miles']) && $profile['miles'] !== 'hide')
              <p class="text-muted">Miles Logged:</p>
              <p>{{ $milesTotal }} NM</p>
            @endif
            {{-- Boat profile --}}
            @unless(empty($profile['boat_type']))
              <p class="text-muted">Boat type:</p>
              <p>{{ $profile['boat_type'] }}</p>
            @endunless
            @unless(empty($profile['model']))
              <p class="text-muted">Model:</p>
              <p>{{ $profile['model'] }}</p>
              @endunless
            @unless(empty($profile['location']) || $user->type == 'crew')
              <p class="text-muted">Location:</p>
              <p>{{ $profile['location'] }}</p>
              @endunless
            @unless(empty($profile['sailing_type']))
              <p class="text-muted">Type of Sailing:</p>
              <p>{{ $profile['sailing_type'] }}</p>
            @endunless
            @unless(empty($profile['crew_size']))
              <p class="text-muted">Usual Crew Size:</p>
              <p>{{ $profile['crew_size'] }}</p>
            @endunless
            @unless(empty($profile['contact_person']))
              <p class="text-muted">Contact Person:</p>
              <p>{{ $profile['contact_person'] }}</p>
            @endunless
            <p class="text-muted" id="contact">Profile Status:</p>
            <p>{{ $user->status }}</p>
          </blockquote>
          @unless($myprofile)
            <a class="btn btn-outline-primary" href="{{ route('messages.show', $user->id) }}">
                        Contact {{ $user->username }}</a>
            <a class="btn btn-outline-primary" href="{{ route('recommendation.show', $user->id) }}">Leave recommendation</a>
          @endunless
        </div>
      </div>
    </div>
@stop

@section('content')
    <div class="col-md-8 offset-md-1">
      <div class="card border-primary box">
        <div class="card-body">
          <blockquote class="card-blockquote">
              @if($user->type == 'crew')
                <h4>About Me</h4>
              @endif
              @if($user->type == 'boat')
                <h4>About Us</h4>
              @endif
              @unless(empty($profile['about']))
                <div class="card">
                  <div class="card-body">
                    <p class="card-text">{!! nl2br(e($profile['about'])) !!}</p>
                  </div>
                </div>
              @endunless
          </blockquote>
        </div>
      </div>
      <div class="card border-primary box" id="log">
        <div class="card-body">
          <blockquote class="card-blockquote">
              <h4>Sailing Log</h4>
              @foreach($logItems as $logItem)
                <div class="card inner-box">
                  <h5 class="card-header">
                    {{ $logItem->itinerary }}
                    @if($user->type == 'crew' && !empty($logItem->miles))
                      / {{ $logItem->miles }} NM
                    @endif
                  </h5>
                  <div class="card-body">
                    <h6 class="card-title">{{ $logItem->dates }}</h6>
                    <p class="card-text">{!! nl2br(e($logItem->description)) !!}</p>
                  </div>
                </div>
              @endforeach
              {{ $logItems->links('vendor.pagination.bootstrap-4') }}
              <a class="text-muted" href="#">Back to top</a>
          </blockquote>
        </div>
      </div>
      @if(sizeof($recommendations)!=0)
        <div class="card border-primary box" id="recommendations">
          <div class="card-body">
            <blockquote class="card-blockquote">
                <h4>Recommendations</h4>
                @foreach ($recommendations as $recommendation)
                  <div class="card inner-box">
                    <a href="{{ route('profile.show', $recommendation->from_id) }}">
                      <h5 class="card-header">{{ $recommendation->username }}</h5>
                    </a>
                    <div class="card-body">
                      <h6 class="card-title">{{ $recommendation->created_at->format('jS F Y') }}</h6>
                      <p class="card-text">{!! nl2br(e($recommendation->recommendation)) !!}</p>
                    </div>
                  </div>
                @endforeach
                {{ $recommendations->links('vendor.pagination.bootstrap-4') }}
                <a class="text-muted" href="#">Back to top</a>
            </blockquote>
          </div>
        </div>
      @endif
    </div>
@stop
