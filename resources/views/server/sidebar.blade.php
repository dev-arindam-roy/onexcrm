<div class="list-group sticky-sidebar" id="devServerInfoSidebar">
  <div class="rounded devServerInfoSidebar__inner">
    <a href="{{ route('system.info') }}" class="list-group-item list-group-item-action {{ request()->routeIs('system.info') ? 'active' : '' }}">
      System Information
    </a>
    <a href="{{ route('php.info') }}" class="list-group-item list-group-item-action {{ request()->routeIs('php.info') ? 'active' : '' }}">
      PHP Information
    </a>
    <a href="{{ route('active.extensions') }}" class="list-group-item list-group-item-action {{ request()->routeIs('active.extensions') ? 'active' : '' }}">
      Active Extensions
    </a>
    <a href="{{ route('server.info') }}" class="list-group-item list-group-item-action {{ request()->routeIs('server.info') ? 'active' : '' }}">
      Server Information
    </a>
    <a href="{{ route('laravel.info') }}" class="list-group-item list-group-item-action {{ request()->routeIs('laravel.info') ? 'active' : '' }}">
      Laravel Information
    </a>
  </div>
</div>