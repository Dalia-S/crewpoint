@extends('layouts.layout')

@section('title')
    {{ config('app.name') }}
@stop

@section('body-id')
    id="home"
@stop

@section('content')
    <div class="jumbotron col-md-8 offset-md-2">

        <h1 class="display-3">Crew Point</h1>

        <h5><b>This is a <a href="http://baltictalents.lt/">Baltic Talents Academy</a> PHP course project by Dalia Saltenyte.</b></h5>
        <p>Crew Point is a site designed to help sailors to connect with boats looking for crew.</p>
        <h5>Key features:</h5>
        <ul>
          <li>Users can register with either Crew or Boat profile (profiles can be edited and customised)</li>
          <li>Users can browse crew or boat lists that can be sorted based on the key profile features</li>
          <li>Users can message each other and leave recommendations</li>
          <li>Admins have an option to export user lists to .xls file</li>
        </ul>
        <h5>Demo accounts:</h5>
        <ul>
          <li>Crew profile: "crew@crew.com" - "password"</li>
          <li>Boat profile: "boat@boat.com" - "password"</li>
          <li>Admin profile: "admin@admin.com" - "password"</li>
        </ul>
        <h5><b>You are also welcome to register as a new user.</b></h5>
        <p class="text-muted">Registration, Log In, Forgot Your Password, Delete Account features are fully functional.</p>

    </div>
@stop
