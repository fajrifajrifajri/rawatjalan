@extends('layouts.Administrator')

@section('content')
	<div id="pasien" class="col-md-10">
	@if(Auth::user()->roles == "administrator")
		@include('inc.errMessages')
			<!-- Button & Modal -->
			<button type="button" class="btn btn-primary btn-add" data-toggle="modal" data-target="#exampleModalCenter">Pasien Baru<i class="fas fa-plus-circle"></i></button>
			<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Pasien Baru</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <form method="POST" id="inputPasien" action="/administrator/pasien">
					  <div class="modal-body">
							@csrf
							<div class="alert alert-warning text-center" role="alert">
							  !! SANGAT TIDAK DIANJURKAN UNTUK INPUT DATA PASIEN MELALUI ADMINISTRATOR, LEBIH BAIK DAFTAR MELALUI INPUT RESEPSIONIS !!
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
								<label for="rekam_medis">Rekam Medis</label>
								<input class="form-control" placeholder="RM0850" name="rekam_medis" type="text" id="rekam_medis"/>
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
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<input class="btn btn-primary" type="submit" value="Submit"/>
					  </div>
				  </form>
				</div>
			  </div>
			</div>
			<!-- Tabel -->
			<table id="tbl_pasien" class="ui celled table" style="width:100%">
				<thead>
					<tr>
						<th></th>
						<th>Nama Pasien</th>
						<th>Kelamin</th>
						<th>Tanggal Lahir</th>
						<th>Alamat</th>
						<th>Rekam Medis</th>
						<th>Poliklinik</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
			<div id="buka-rm" class="my-4">
				<h2>REKAM MEDIS</h2>
				<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#r">
				  BUKA
				</a>
				<div class="modal fade" id="r" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Rekam Medis</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						<table id="tbl_rekam_medis_antrian" class="ui celled table" style="width:100%">
							<thead>
								<tr>
									<th></th>
									<th>Nama Pasien</th>
									<th>Kelamin</th>
									<th>Tanggal Lahir</th>
									<th>Alamat</th>
									<th>Rekam Medis</th>
									<th>Tanggal Berobat</th>
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
			</div>
		@else
			<div class="privilege-administrator">
				<h1>HANYA DAPAT DIAKSES ADMINISTRATOR</h1>
			</div>
	@endif
	</div>
@endsection