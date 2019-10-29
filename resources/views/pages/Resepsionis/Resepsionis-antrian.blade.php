@extends('layouts.Resepsionis')

@section('content')
	<div id="antrian" class="row">
		<div class="col-md-8">
			<select id="poliFilter">
				<option></option>
            </select>
			<!-- -->
			<table id="tbl_antrian" class="ui celled table" style="width:100%">
				<thead>
					<tr>
						<th>Nama</th>
						<th>Kelamin</th>
						<th>Tanggal Lahir</th>
						<th>Alamat</th>
						<th>Rekam Medis</th>
						<th>Datang</th>
						<th>Poliklinik</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
				<tfoot>
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</tfoot>
			</table>
		</div>
		<div class="col-md-4">
			<div>
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
				<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-door-open"></i><span>KELUAR</span></a>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				@csrf
				</form>
			</div>
		</div>
	</div>
@endsection