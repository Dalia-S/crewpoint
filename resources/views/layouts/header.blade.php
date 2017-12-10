<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="shotcut icon" href="{{ URL::asset('img/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ URL::asset('css/bootswatch.min.css') }}" media="screen">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}" media="screen">
  </head>
  <body @yield('body-id')>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="{{ url('') }}">
        <img src="{{ URL::asset('img/logo.png') }}"/>CP</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation" style="">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('about') }}">About Us</a>
          </li>
          @auth
            <li class="nav-item">
              <a class="nav-link" href="{{ route('unsortedList', ['type' => 'crew', 'status' => 'active']) }}">Crew</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('unsortedList', ['type' => 'boat', 'status' => 'active']) }}">Boats</a>
            </li>
          @endauth
          <li class="nav-item">
            <a class="nav-link" href="{{ route('faq') }}">FAQ</a>
          </li>
        </ul>
        <div class="">
          @guest
            <a class="btn btn-outline-primary" href="{{ route('login') }}">Log In</a>
            <a class="btn btn-outline-primary" href="{{ route('register') }}">Register</a>
          @else
            <a class="nav-link" href="{{ route('profile.index') }}">My Profile</a>
            <a class="btn btn-outline-primary" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                Log Out
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
          @endguest
        </div>
      </div>
    </nav>
