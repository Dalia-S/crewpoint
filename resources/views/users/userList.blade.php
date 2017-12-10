@extends('layouts.layout')

@section('title')
    CP - Crew List
@stop

@if($type == 'boat')
  @section('body-id')
      id="boats"
  @stop
@endif

@section('content')
  <div class="col list">
    @if($type == 'crew')
      <div class="topbar">
        <a class="@if($status == 'active') active @endif" href="{{ url('/list/crew/active') }}"><h5>Active crew</h5></a>
        <a class="@if($status == 'inactive') active @endif" href="{{ url('/list/crew/inactive') }}"><h5>Inactive crew</h5></a>
        @if($user->role == 'admin')
          <a class="export" href="{{ route('export', ['type' => 'crew', 'status' => 'inactive']) }}"><h5>Download inactive crew list</h5></a>
          <a class="export" href="{{ route('export', ['type' => 'crew', 'status' => 'active']) }}"><h5>Download active crew list</h5></a>
        @endif
      </div>
    @endif
    @if($type == 'boat')
      <div class="topbar boatsTopbar">
        <a class="@if($status == 'active') active @endif" href="{{ url('/list/boat/active') }}"><h5>Active boats</h5></a>
        <a class="@if($status == 'inactive') active @endif" href="{{ url('/list/boat/inactive') }}"><h5>Inactive boats</h5></a>
        @if($user->role == 'admin')
          <a class="export" href="{{ route('export', ['type' => 'boat', 'status' => 'inactive']) }}"><h5><b>Download inactive boat list</b></h5></a>
          <a class="export" href="{{ route('export', ['type' => 'boat', 'status' => 'active']) }}"><h5><b>Download active boat list</b></h5></a>
        @endif
      </div>
    @endif
    <div class="card border-primary">
      @if($type == 'crew')
        @if($status == 'active')
          <h5 class="card-header">Crew actively looking for sailing opportunities</h5>
        @endif
        @if($status == 'inactive')
          <h5 class="card-header">Crew currently not looking for sailing opportunities</h5>
        @endif
      @endif
      @if($type == 'boat')
        @if($status == 'active')
          <h5 class="card-header">Boats actively looking for crew</h5>
        @endif
        @if($status == 'inactive')
          <h5 class="card-header">Boats currently not looking for crew</h5>
        @endif
      @endif
      <div class="card-body">
        <blockquote class="card-blockquote">
          <div class="sort">
            <h6>Sort by:</h6>
            @if($type == 'crew')
              <a href="{{ url('/list/crew/'.$status.'/location/asc') }}" @if($sortKey == 'location') class= "highlight" @endif>Location</a>
              <a href="{{ url('/list/crew/'.$status.'/qualification/desc') }}" @if($sortKey == 'qualification') class= "highlight" @endif>Qualification</a>
              <a href="{{ url('/list/crew/'.$status.'/miles/desc') }}" @if($sortKey == 'miles') class= "highlight" @endif>Miles Logged</a>
              <a href="{{ url('/list/crew/'.$status.'/recom/desc') }}" @if($sortKey == 'recom') class= "highlight" @endif>No of Recommendations</a>
            @endif
            @if($type == 'boat')
              <a href="{{ url('/list/boat/'.$status.'/location/asc') }}" @if($sortKey == 'location') class= "highlight" @endif>Location</a>
              <a href="{{ url('/list/boat/'.$status.'/model/asc') }}" @if($sortKey == 'model') class= "highlight" @endif>Model</a>
              <a href="{{ url('/list/boat/'.$status.'/sailing_type/asc') }}" @if($sortKey == 'sailing_type') class= "highlight" @endif>Type of Sailing</a>
              <a href="{{ url('/list/boat/'.$status.'/recom/desc') }}" @if($sortKey == 'recom') class= "highlight" @endif>No of Recommendations</a>
            @endif
          </div>
          <div class="sort">
            <h6>Show per page:</h6>
            @empty($sortKey)
              <a href="{{ url('/list/'.$type.'/'.$status.'/10') }}" @if($perPage == '10') class= "highlight" @endif>10</a>
              <a href="{{ url('/list/'.$type.'/'.$status.'/20') }}" @if($perPage == '20') class= "highlight" @endif>20</a>
              <a href="{{ url('/list/'.$type.'/'.$status.'/50') }}" @if($perPage == '50') class= "highlight" @endif>50</a>
            @endempty
            @unless(empty($sortKey))
              <a href="{{ url('/list/'.$type.'/'.$status.'/'.$sortKey.'/'.$sortOrder.'/10') }}" @if($perPage == '10') class= "highlight" @endif>10</a>
              <a href="{{ url('/list/'.$type.'/'.$status.'/'.$sortKey.'/'.$sortOrder.'/20') }}" @if($perPage == '20') class= "highlight" @endif>20</a>
              <a href="{{ url('/list/'.$type.'/'.$status.'/'.$sortKey.'/'.$sortOrder.'/50') }}" @if($perPage == '50') class= "highlight" @endif>50</a>
            @endunless
          </div>
          {{ $profiles->setPath(Request::url())->links('vendor.pagination.bootstrap-4') }}
          <div class="responsiveTable">
            <table class="table table-striped table-hover table-bordered">
              <thead class="thead-dark">
                <tr>
                  @if($type == 'crew')
                    <th></th>
                    <th>Username</th>
                    <th>Location</th>
                    <th>Qualification</th>
                    <th>Miles Logged</th>
                    <th>Recom</th>
                    <th></th>
                  @endif
                  @if($type == 'boat')
                    <th></th>
                    <th>Username</th>
                    <th>Location</th>
                    <th>Model</th>
                    <th>Type of Sailing</th>
                    <th>Recom</th>
                    <th></th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @if($type == 'crew')
                  @foreach ($profiles as $id => $profile)
                    <tr>
                      <td class='listImg'>
                        @empty($profile['photo'])
                          <img src="{{ URL::asset('img/crewprofile.png') }}" alt="profile photo" />
                        @endempty
                        @unless(empty($profile['photo']))
                          <img src="{{ URL::asset('storage/photos/'.$profile['photo'].'') }}" alt="profile photo" />
                        @endunless
                      </td>
                      <td>{{ $profile['username'] }}</td>
                      <td>{{ !empty($profile['location'])?$profile['location']:' - ' }}</td>
                      <td>{{ !empty($profile['qualification'])?$profile['qualification']:' - ' }}</td>
                      <td>{{ !empty($profile['miles'])?$profile['miles'].' NM':' - ' }}</td>
                      <td>{{ !empty($profile['recom'])?$profile['recom']:' - ' }}</td>
                      <td><a class='btn btn-outline-primary' href="{{ route('profile.show', $id) }}">View Profile</a></td>
                    </tr>
                  @endforeach
                @endif
                @if($type == 'boat')
                  @foreach ($profiles as $id => $profile)
                    <tr>
                      <td class='listImg'>
                        @empty($profile['photo'])
                          <img src="{{ URL::asset('img/boatprofile.jpg') }}" alt="profile photo" />
                        @endif
                        @unless(empty($profile['photo']))
                          <img src="{{ URL::asset('storage/photos/'.$profile['photo'].'') }}" alt="profile photo" />
                        @endunless
                      </td>
                      <td>{{ $profile['username'] }}</td>
                      <td>{{ !empty($profile['location'])?$profile['location']:' - ' }}</td>
                      <td>{{ !empty($profile['model'])?$profile['model']:' - ' }}</td>
                      <td>{{ !empty($profile['sailing_type'])?$profile['sailing_type']:' - ' }}</td>
                      <td>{{ !empty($profile['recom'])?$profile['recom']:' - ' }}</td>
                      <td><a class='btn btn-outline-primary' href="{{ route('profile.show', $id) }}">View Profile</a></td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
          {{ $profiles->setPath(Request::url())->links('vendor.pagination.bootstrap-4') }}
          <a class="text-muted" href="#">Back to top</a>
        </blockquote>
      </div>
    </div>
  </div>
@stop
