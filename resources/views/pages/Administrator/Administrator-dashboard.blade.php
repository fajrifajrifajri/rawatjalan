@extends('layouts.Administrator')

@section('content')
	<div id="dashboard" class="col-md-10">
	@if(Auth::user()->roles == "administrator")
		<div class="row">
			<div class="col-md-8">
				
			</div>
			<div class="col-md-4">
				<div class="dashboard-card">
					<i class="fas fa-users"></i>
					<a class="btn btn-primary" href="{{ route('daftar.index') }}">Registrasi User</a>
					<a class="btn btn-primary" href="{{ route('ubah-user.index') }}">Atur User</a>
				</div>
			</div>
		</div>
		@else
			<div class="privilege-administrator">
				<h1>HANYA DAPAT DIAKSES ADMINISTRATOR</h1>
			</div>
	@endif
	</div>
@endsection