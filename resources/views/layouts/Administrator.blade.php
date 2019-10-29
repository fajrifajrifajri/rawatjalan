<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Aplikasi Rawat Jalan</title>
  @include('inc.head')
</head>
<body id="administrator">
	@include('inc.Administrator-nav')
	<main>
		<div class="row">
			@include('inc.Administrator-sidebar')
			@yield('content')
		</div>
	</main>
	@include('inc.scripts')
	<script>
	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	})
	</script>
</body>
</html>