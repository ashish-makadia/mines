<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Mine | Dashboard</title>
  @include('layout.css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
	<!-- Preloader -->
	<div class="preloader flex-column justify-content-center align-items-center">
		<img class="animation__shake" src="{{ asset('assets/dist/img/logo.png') }}" alt="Acme Mine" height="60" width="60">
	</div>



@yield('content')

@include('layout.script')

@yield('other-scripts')
</body>
</html>



