@extends('layouts.Administrator')

@section('content')
	<div id="dokter" class="col-md-10">
	@if(Auth::user()->roles == "administrator")
		@include('inc.errMessages')
			<!-- Button & Modal -->
			<button type="button" class="btn btn-primary btn-add" data-toggle="modal" data-target="#modalDokter">Dokter Baru<i class="fas fa-plus-circle"></i></button>
			<div class="modal fade" id="modalDokter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Dokter Baru</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <form method="POST" action="{{ route('dokter.store') }}" enctype="multipart/form-data">
					  <div class="modal-body">
							@csrf
							<div class="form-group">
								<label for="nama_dokter">Nama Dokter</label>
								<input class="form-control" placeholder="Dr.Sri Sulistiawati,Psi" name="nama_dokter" type="text" id="nama_dokter"/>
							</div>
							<div class="form-group">
								<label for="poli">Poliklinik</label>
								<select class="custom-select" name="poli" id="poli">
									@if(count($poliklinik) > 0)
										@foreach($poliklinik as $poli)
											<option value="{{$poli->id}}">{{$poli->nama_poli}}</option>
										@endforeach
									@else
										<option value="">-- ISI POLIKLINIK TERLEBIH DAHULU --</option>
									@endif
								</select>
							</div>
							<div class="form-group">
								<label for="alamat">Alamat</label>
								<input class="form-control" placeholder="Jl. Nusantara Raya, Kecamatan Satu, Jakarta Pusat" name="alamat" type="text" id="alamat"/>
							</div>
							<div class="form-group">
								<label for="telp">Telp</label>
								<input class="form-control" placeholder="08xxxx" name="telp" type="text" id="telp"/>
							</div>
							<div class="form-group d-flex flex-column">
								<label for="foto">Foto</label>
								<input type="file" name="foto">
								<div>{{ $errors->first('foto') }}</div>
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
			<table id="tbl_dokter" class="ui celled table" style="width:100%">
				<thead>
					<tr>
						<th></th>
						<th>Nama Dokter</th>
						<th>Poliklinik</th>
						 <th>Foto</th>
						<th>Alamat</th>
						<th>Telp</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
			<!-- Button & Modal -->
			<button class="btn btn-primary btn-add" data-toggle="modal" data-target="#modalPoliklinik">Poliklinik<i class="fas fa-plus-circle"></i></button>
			<div class="modal fade" id="modalPoliklinik" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Poliklinik</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <form method="POST" action="{{ route('poliklinik.store') }}">
					  <div class="modal-body">
							@csrf
							<div class="form-group">
								<label for="nama_poliklinik">Nama Poliklinik</label>
								<input class="form-control" name="nama_poliklinik" type="text" id="nama_poliklinik"/>
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
			<table id="tbl_poliklinik" class="ui celled table" style="width:100%">
				<thead>
					<tr>
						<th>Nama Poliklinik</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		@else
			<div class="privilege-administrator">
				<h1>HANYA DAPAT DIAKSES ADMINISTRATOR</h1>
			</div>
	@endif
	</div>
@endsection