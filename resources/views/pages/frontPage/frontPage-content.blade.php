@extends('layouts.frontPage')

@section('content')
	<main>
		<div id="home">
			<h1>Pilih sebagai...</h1>
			<a href="/administrator" class="btn btn-light">Administrator</a>
			<a href="/resepsionis/pasien" class="btn btn-light">Resepsionis</a>
			<a href="/administrator/pemeriksaan" class="btn btn-light">Apoteker</a>
		</div>
	</main>
@endsection