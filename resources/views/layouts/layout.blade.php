@include('layouts.header')

<div class="container">

  <div class="row">

        @yield('topbar')
        
  </div>

    <div class="row">

        @yield('sidebar')

        @yield('content')

    </div>


</div>

@include('layouts.footer')
