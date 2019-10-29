@extends('layouts.Apoteker')

@section('content')
	<div id="obat" class="col-md-10">
	@if(Auth::user()->roles == "apoteker" || Auth::user()->roles == "administrator")
		@include('inc.errMessages')
			<!-- Button & Modal & Form -->
			<button class="btn btn-primary btn-add" data-toggle="modal" data-target="#modalObat">Obat Bebas<i class="fas fa-plus-circle"></i></button>
			<div class="modal fade" id="modalObat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Obat Bebas</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <form method="POST" action="{{ route('obat.store') }}">
					  <div class="modal-body">
							@csrf
							<div class="form-group">
								<label for="nama_obat">Nama Obat</label>
								<input class="form-control" placeholder="Paracetamol" name="nama_obat" type="text" id="nama_obat"/>
							</div>
							<div class="form-group">
								<label for="jenis_obat">Jenis Obat</label>
								<input class="form-control" placeholder="liquid, serbuk, butir" name="jenis_obat" type="text" id="jenis_obat"/>
							</div>
							<div class="form-group">
								<label for="satuan">Satuan</label>
								<input class="form-control" placeholder="tablet, pil, botol" name="satuan" type="text" id="satuan"/>
							</div>
							<div class="form-group">
								<label for="harga_satuan">Harga Satuan</label>
								<div style="font-size: 0;"> <!-- Untuk menghapus garis batas invisible antar inline-block -->
									<input class="form-control" placeholder="Rp." type="text" id="rp_harga_satuan" disabled/>
									<input class="form-control" placeholder="10.000" name="harga_satuan" type="text" id="harga_satuan"/>
								</div>
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
			<table id="tbl_obat" class="ui celled table" style="width:100%">
				<thead>
					<tr>
						<th>Nama Obat</th>
						<th>Jenis Obat</th>
						<th>Satuan</th>
						<th>Harga Satuan</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
			<!-- Button & Modal & Form -->
			<button class="btn btn-primary btn-add" data-toggle="modal" data-target="#modalResep">Resep Dokter<i class="fas fa-plus-circle"></i></button>
			<div class="modal fade" id="modalResep" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Resep</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <form method="POST" action="{{ route('resep-dokter.store') }}">
					  <div class="modal-body">
							@csrf
							<div class="form-group">
								<label for="nama_obat">Nama Obat</label>
								<input class="form-control" placeholder="Paracetamol" name="nama_obat" type="text" id="nama_obat"/>
							</div>
							<div class="form-group">
								<label for="jenis_obat">Jenis Obat</label>
								<input class="form-control" placeholder="liquid, serbuk, butir" name="jenis_obat" type="text" id="jenis_obat"/>
							</div>
							<div class="form-group">
								<label for="satuan">Satuan</label>
								<input class="form-control" placeholder="tablet, pil, botol" name="satuan" type="text" id="satuan"/>
							</div>
							<div style="font-size: 0;"> <!-- Untuk menghapus garis batas invisible antar inline-block -->
								<input class="form-control" placeholder="Rp." type="text" id="rp_harga_satuan" disabled/>
								<input class="form-control" placeholder="10.000" name="harga_satuan" type="text" id="harga_satuan"/>
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
			<table id="tbl_resep_dokter" class="ui celled table" style="width:100%">
				<thead>
					<tr>
						<th>Nama Obat</th>
						<th>Jenis Obat</th>
						<th>Satuan</th>
						<th>Harga Satuan</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		@else
			<div class="privilege-administrator">
				<h1>HANYA DAPAT DIAKSES APOTEKER / ADMINISTRATOR</h1>
			</div>
	@endif
	</div>
@endsection