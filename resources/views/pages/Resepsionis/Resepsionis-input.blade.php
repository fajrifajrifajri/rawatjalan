@extends('layouts.Resepsionis')

@section('content')
	<div id="input" class="row">
		<div class="col-md-8">
		@if(Auth::user()->roles == "resepsionis" || Auth::user()->roles == "administrator")
			<h1>Pendaftaran Pasien</h1>
			<form method="POST" action="/resepsionis/pasien">
				@csrf
				<div class="form-group">
					<label for="rekam_medis">Rekam Medis <a href="#" id="kosongkan"><i class="fas fa-sync-alt"></i></a></label>
					<input class="form-control" placeholder="Pasien Baru" name="rekam_medis" type="text" id="rekam_medis" readonly/>
				</div>
				<div class="form-group">
					<label for="nama_pasien">Nama Pasien</label>
					<input class="form-control" placeholder="Indah Dewi" name="nama_pasien" type="text" id="nama_pasien"/>
				</div>
				<div class="btn-group btn-group-toggle" data-toggle="buttons">
					<label class="btn btn-secondary">
						<input type="radio" name="kelamin" id="kelamin1" autocomplete="off" value="Pria"> Pria
					</label>
					<label class="btn btn-secondary">
						<input type="radio" name="kelamin" id="kelamin2" autocomplete="off" value="Wanita"> Wanita
					</label>
				</div>
				<div class="form-group">
					<label for="tanggal_lahir">Tanggal Lahir</label>
					<input class="form-control" name="tanggal_lahir" type="date" id="tanggal_lahir"/>
				</div>
				<div class="form-group">
					<label for="alamat">Alamat</label>
					<textarea class="form-control" placeholder="Jl. Nusantara Raya, Kecamatan Satu, Jakarta Pusat" name="alamat" type="text" id="alamat" rows="2"></textarea>
				</div>
				<div class="form-group">
					<label for="poliklinik">Poliklinik</label>
					<select class="custom-select" name="poliklinik" id="poliklinik">
					@if(count($data['poliklinik']) > 0)
						@foreach($data['poliklinik'] as $poliklinik)
						<option value="{{$poliklinik->id}}" selected>{{$poliklinik->nama_poli}}</option>
						@endforeach
					@endif
					</select>
				</div>
				<div class="text-center">
					<input class="btn btn-primary" type="submit" value="Submit"/>
				</div>
			</form>
			@else
				<div class="privilege-resepsionis">
					<h2>HANYA DAPAT DIAKSES RESEPSIONIS / ADMINISTRATOR</h2>
				</div>
		@endif
		</div>
		<div class="col-md-4">
			<div>
				@if(Auth::user()->roles == "resepsionis" || Auth::user()->roles == "administrator")
				<a href="#" data-toggle="modal" data-target="#exampleModalCenter">
				  <i class="fas fa-user-injured"></i><span>REKAM MEDIS</span>
				</a>
				<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Rekam Medis</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						<table id="tbl_rekam_medis" class="ui celled table" style="width:100%">
							<thead>
								<tr>
									<th></th>
									<th></th>
									<th>Nama Pasien</th>
									<th>Kelamin</th>
									<th>Tanggal Lahir</th>
									<th>Alamat</th>
									<th>Rekam Medis</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal" style="width:100%;">Close</button>
					  </div>
					</div>
				  </div>
				</div>
				@endif
				<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-door-open"></i><span>KELUAR</span></a>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				@csrf
				</form>
			</div>
		</div>
	</div>
@endsection