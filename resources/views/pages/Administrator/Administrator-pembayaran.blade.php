@extends('layouts.Apoteker')

@section('content')
	<div id="pembayaran" class="col-md-10">
	@if(Auth::user()->roles == "apoteker" || Auth::user()->roles == "administrator")
		@include('inc.errMessages')
	
		<h2>DATA PEMBAYARAN</h2>
		
		<!-- DataTables Rekam Medis (untuk Apoteker) -->
		<button class="btn btn-link" data-toggle="modal" data-target="#r"><i class="fas fa-user-injured"></i></button>
		<div class="modal fade" id="r" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Rekam Medis | SEMUA</h5>
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
		
		
		<!-- Tabel -->
		<table id="tbl_pembayaran" class="ui celled table" style="width:100%">
			<thead>
				<tr>
					<th>Tanggal berobat</th>
					<th></th>
					<th>No. Rekam Medis</th>
					<th>Nama Pasien</th>
					<th>Nama Poliklinik</th>
					<th>Total Biaya</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
		
		<!-- Modal Cetak -->
		<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="modalTitle"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body" id="printThis">
					<div class="row">
						<div class="col-md-12 text-center mb-md-1">
							<h2 class="font-weight-bold">
								RS. PINNA BEKASI
							</h2>
						</div>
						<div class="col-md-12 text-center">
							<h4>
								Jl. Karang Satria no.4-5, Tambun Utara, Bekasi
							</h4>
						</div>
					</div>
					<hr>
					<hr>
					<div class="row">
						<div class="col-md-3">
							No. RM
						</div>
						<div id="rm" class="col-md-3">
						</div>
						<div class="col-md-3">
							Klinik
						</div>
						<div id="nama_poli" class="col-md-3">
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							Nama Lengkap
						</div>
						<div id="nama" class="col-md-3">
						</div>
						<div class="col-md-3">
							Penyakit
						</div>
						<div id="penyakit" class="col-md-3">
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							Kelamin
						</div>
						<div id="kelamin" class="col-md-3">
						</div>
						<div class="col-md-3">
							Pemeriksa
						</div>
						<div id="nama_dokter" class="col-md-3">
						</div>
					</div>
					<div class="row mb-md-2">
						<div class="col-md-3">
							Alamat
						</div>
						<div id="alamat" class="col-md-3">
						</div>
						<div class="col-md-3">
							Keterangan
						</div>
						<div id="keterangan" class="col-md-3">
						</div>
					</div>
					<hr class="mt-md-4">
					<hr class="mb-md-4">
					<div class="row mb-md-2">
						<div class="col-md-12">
							<h4 class="font-weight-bold text-center">
								Resep Dokter & Obat Bebas
							</h4>
						</div>
					</div>
					<ol id="resepObat" style="display:flex; flex-wrap: wrap;">
						
						
					</ol>
					<hr>
					<div class="row mt-md-3">
						<div class="col-md-12">
							Total Harga: :<span id="total"></span>
						</div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" id="btnPrint" class="btn btn-primary p-md-2" style="width: 100%; display:none;">CETAK</button>
				  </div>
				</div>
			</div>
		</div>
		</div>
		@else
			<div class="privilege-administrator privilege-pembayaran">
				<h1>HANYA DAPAT DIAKSES APOTEKER / ADMINISTRATOR</h1>
			</div>
	@endif
@endsection