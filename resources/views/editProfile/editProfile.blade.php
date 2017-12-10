@extends('layouts.layout')

@section('title')
    CP - Edit Profile
@stop

@if($user->type == 'boat')
  @section('body-id')
      id="boats"
  @stop
@endif

@section('topbar')
  <div class="topbar @if($user->type == 'boat') boatsTopbar @endif">
    <a href="#log"><h5>Sailing Log</h5></a>
    @if(sizeof($recommendations)!=0)
      <a href="#recommendations"><h5>Recommendations</h5></a>
    @endif
  </div>
@stop

@section('sidebar')
    <div class="col-md-3 sidebar edit-sidebar">
      <div class="card border-primary ">
        <div class="card-body">
          <blockquote class="card-blockquote">
            <h5>Profile photo:</h5>
            <form action="{{ route('storephoto') }}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              @if(empty($profile['photo']) && $user->type == 'crew')
                <img src="{{ URL::asset('img/crewprofile.png') }}" alt="profile photo" />
              @endif
              @if(empty($profile['photo']) && $user->type == 'boat')
                <img src="{{ URL::asset('img/boatprofile.jpg') }}" alt="profile photo" />
              @endif
              @if(!empty($profile['photo']))
                <img src="{{ URL::asset('storage/photos/'.$profile['photo'].'') }}" alt="profile photo" />
              @endif
              <div class="form-group">
                <input name="photo" type="file" class="form-control-file">
                <small class="form-text text-muted">Max size 1Mb</small>
                @if($errors->has('photo'))
                    <span class="help-block">
                        <strong>{{ $errors->first('photo') }}</strong>
                    </span>
                @endif
              </div>
              <button type="submit" class="btn btn-outline-primary">Change photo</button>
            </form>
            <h5>Profile details:</h5>
            @if($user->type == 'crew')
              @include('editProfile.crewForm')
              @yield('crewForm')
            @endif
            @if($user->type == 'boat')
              @include('editProfile.boatForm')
              @yield('boatForm')
            @endif
            <a href="{{ route('profile.index') }}">Go to My Profile</a>
          </blockquote>
          <a id="account"></a>
          <a class="text-muted" href="{{ route('deleteAccount', 'delete').'#account' }}">Delete Account</a>
          @if(!empty($deleteAcc) && $user->role == 'user')
          <div class="card text-white bg-danger deleteAccount">
            <div class="card-body">
              <h4><b>Are you sure?</b></h4>
              <h6><b>ALL DATA WILL BE LOST!</b></h6>
              <a href="{{ route('confirmDelete') }}" class="btn btn-outline-primary">DELETE<br>My Account</a>
            </div>
          </div>
          @endif
          @if(!empty($deleteAcc) && $user->role !== 'user')
          <div class="card text-white bg-danger deleteAccount">
            <div class="card-body">
              <h4><b>Are you sure?</b></h4>
              <h6><b>ALL DATA WILL BE LOST!</b></h6>
              <a href="#account" class="btn btn-outline-primary">DELETE<br>My Account</a>
              <h5><b>Delete Account</b> option for Demo accounts is <b>disabled</b>.</h5>
            </div>
          </div>
          @endif
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
            <div class="card">
              <div class="card-body">
                <form class="editProfile" action="{{route('storeabout')}}" method="POST">
                  {{ method_field('POST') }}
                  {{ csrf_field() }}
                  <div class="form-group">
                    <textarea name="about" class="form-control" rows="5" placeholder="What should Crew Point members know about you?">{{ isset($profile['about'])?$profile['about']:'' }}</textarea>
                  </div>
                  <button type="submit" class="btn btn-outline-primary">Save Changes</button>
                </form>
                @if(Session::has('success'))
                  <p class="alert alert-success">{{ session('success') }}</p>
                @endif
              </div>
            </div>
          </blockquote>
        </div>
      </div>
      <div class="card border-primary box">
        <div class="card-body">
          <blockquote class="card-blockquote">
              <h4>Sailing Log</h4>
              <div class="card inner-box" id='newitem'>
                <div class="card-body">
                  <h5 class="sub-header">New Entry:</h5>
                  <form class="editProfile" action="{{ route('log.store') }}" method="POST">
                    {{ method_field('POST') }}
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label>Dates:</label>
                      <input name="dates" type="text" class="form-control" placeholder="e.g. June-July 2016" value="{{ old('dates') }}" required>
                      @if($errors->has('dates'))
                          <span class="help-block">
                              <strong>{{ $errors->first('dates') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label>Itinerary:</label>
                      <input name="itinerary" type="text" class="form-control" placeholder="e.g. St Lucia - Horta, Azores - Plymouth, UK" required>
                      @if($errors->has('itinerary'))
                          <span class="help-block">
                              <strong>{{ $errors->first('itinerary') }}</strong>
                          </span>
                      @endif
                    </div>
                    @if($user->type == 'crew')
                    <div class="form-group">
                      <label>Miles Logged NM:</label>
                      <input name="miles" type="number" class="form-control" placeholder="e.g. 100">
                      @if($errors->has('miles'))
                          <span class="help-block">
                              <strong>{{ $errors->first('miles') }}</strong>
                          </span>
                      @endif
                    </div>
                    @endif
                    <div class="form-group">
                      <label>Short description:</label>
                      <textarea name="description" class="form-control" rows="5" placeholder="Description of your trip" required></textarea>
                      @if($errors->has('miles'))
                          <span class="help-block">
                              <strong>{{ $errors->first('miles') }}</strong>
                          </span>
                      @endif
                    </div>
                    <button type="submit" class="btn btn-outline-primary">Save</button>
                  </form>
                  @if(Session::has('message'))
                    <p class="alert alert-success">{{ session('message') }}</p>
                  @endif
                </div>
              </div>
              <a id="log"></a>
              @if(sizeof($logItems)!=0)
                <h5 class="sub-header">Logged items:</h5>
              @endif
              @foreach($logItems as $logItem)
                <div class="card inner-box">
                  <a class="btn btn-outline-primary" href="{{ route('log.delete', $logItem->id).'#log' }}">Delete</a>
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
      <a id="recommendations"></a>
      @if(sizeof($recommendations)!=0)
        <div class="card border-primary box">
          <div class="card-body">
            <blockquote class="card-blockquote">
              <h4>Recommendations</h4>
              @foreach ($recommendations as $recommendation)
                <div class="card inner-box">
                  <a class="btn btn-outline-primary removeRecom" href="{{ route('recomDelete', $recommendation->id) }}">Request Removal</a>
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
