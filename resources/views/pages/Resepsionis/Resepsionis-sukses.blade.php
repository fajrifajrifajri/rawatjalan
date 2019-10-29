@extends('layouts.Resepsionis')

@section('content')
	<div id="sukses" class="d-flex align-items-center">
	@if(Auth::user()->roles == "resepsionis" || Auth::user()->roles == "administrator")
		<div>
			<i class="fas fa-check-circle"></i>
			<h1>Berhasil terdaftar</h1>
			<h2>atas nama <span>{{$data['name']}}</span></h2>
			<h3>dengan Rekam Medis: <span class="badge badge-info">{{$data['rm']}}</span></h3>
			<a href="/resepsionis/antrian" class="btn btn-secondary">ANTRIAN</a>
			<a href="/resepsionis/pasien" class="btn btn-success">INPUT</a>
		</div>
		@else
			<h2>HANYA DAPAT DIAKSES RESEPSIONIS / ADMINISTRATOR</h2>
	@endif
	</div>
@endsection