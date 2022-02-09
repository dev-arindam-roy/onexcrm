<nav class="navbar navbar-expand-lg navbar-dark bg-primary" id="headerNav">
  <a class="navbar-brand" href="{{ route('webroot') }}"><strong>{{ str_replace('_', ' ', env('CRM_NAME')) }}</strong></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      @if(Session::has('devCoreLogin') && Session::get('devCoreLogin'))
      <li class="nav-item {{ request()->routeIs('devsystem.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('devsystem.dashboard') }}">Dashboard</a>
      </li>
      @endif
    </ul>
    <ul class="navbar-nav ml-auto">
      @if(Session::has('devCoreLogin'))
      <li class="nav-item {{ request()->routeIs('dev.logout') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dev.logout') }}">Logout</a>
      </li>
      @endif
    </ul>
  </div>
</nav>