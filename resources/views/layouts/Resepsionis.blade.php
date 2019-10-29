<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Aplikasi Rawat Jalan</title>
  @include('inc.head')
</head>

<body id="resepsionis">
	@include('inc.Resepsionis-nav')
	<main class="container">
		@include('inc.errMessages')
		@yield('content')
	</main>
	@include('inc.scripts')
	<script>
		$(document).ready(function() {
			$('#kosongkan').click(function() {
				const arrays = ['nama_pasien', 'tanggal_lahir', 'alamat', 'rekam_medis']
				for(x of arrays) {
					$('#'+x).val(null);
				}
				$("#kelamin1").parent().removeClass("active");
				$("#kelamin1").prop("checked", false);
				$("#kelamin2").parent().removeClass("active");
				$("#kelamin2").prop("checked", false);
			})
		}) 
	</script>
</body>
</html>