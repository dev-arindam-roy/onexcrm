<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <title>{{ str_replace('_', ' ', env('CRM_NAME')) }} | @yield('page_title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('assets/bootstrap-4/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/toastr/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}">
  @stack('page_style')
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/server-module.min.css') }}">
  @stack('page_css')
</head>
<body>
<div id="app"></div>
@include('server.header_nav')
<div class="container-fluid mt-3">
  <div class="row">
    <div class="col-md-3 text-center">
      @if(!Session::has('devCoreLogin'))
        <img src="{{ asset('images/creative_syntax.png') }}" class="img-fluid img-thumbnail">
        <p class="mt-3"><strong>System Developed and Managed By <br/> Creative Syntax Team</strong></p>
      @else
        @include('server.sidebar')
      @endif
    </div>
    <div class="col-md-9">@yield('page_content')</div>
  </div>
</div>
<a href="#" id="SmoothScrollToTopBtN" style="display: none;"><span></span></a>
<audio id="success-audio">
  <source src="{{ asset('audio/success.ogg') }}" type="audio/ogg">
  <source src="{{ asset('audio/success.mp3') }}" type="audio/mpeg">
</audio>
<audio id="error-audio">
  <source src="{{ asset('audio/error.ogg') }}" type="audio/ogg">
  <source src="{{ asset('audio/error.mp3') }}" type="audio/mpeg">
</audio>
<audio id="warning-audio">
  <source src="{{ asset('audio/warning.ogg') }}" type="audio/ogg">
  <source src="{{ asset('audio/warning.mp3') }}" type="audio/mpeg">
</audio>

<script src="{{ asset('assets/jquery.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap-4/popper.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap-4/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/sticky-sidebar/jquery.sticky-sidebar.min.js') }}"></script>
<script>
$(document).ready(function () {
  $('.sticky-sidebar').stickySidebar({
    topSpacing: 20,
    bottomSpacing: 60
  });
});
</script>
@stack('page_script')
<script src="{{ asset('js/app.js') }}"></script>
@stack('page_js')

@include('includes.server-toastr')
</body>
</html>
