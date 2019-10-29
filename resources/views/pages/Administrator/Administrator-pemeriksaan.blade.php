@extends('layouts.Apoteker')

@section('content')
	<div id="pemeriksaan" class="col-md-10">
	@if(Auth::user()->roles == "apoteker" || Auth::user()->roles == "administrator")
		@include('inc.errMessages')
		<h2>PASIEN HARI INI</h2>
		<div id="pemeriksaan-pagination" class="form-group">
			<select id="selectpoli" name="poliselected" class="form-control">
				<option value="">-- Pilih Poli --</option>
				@if(count($data['poli']) > 0)
					@foreach($data['poli'] as $poli)
					<option class="{{$poli->id}}">{{$poli->nama_poli}}</option>
					@endforeach
				@endif
			</select>
		</div>
		<div id="pemeriksaan-pasien" class="row">
			@if(count($data['pasien']) > 0)
				@foreach($data['pasien'] as $pasien)
					@if($pasien->periksa == "belum")
					<div class="col-md-4 pasiendifilter {{$pasien->id_poliklinik}}">
						<div class="pasien">
							{{$pasien->nama_pasien}} <span class="badge badge-warning">{{$pasien->poliklinik}}</span><button class="float-right populate" data-toggle="modal" data-target="#exampleModalCenter" id-pasien="{{$pasien->id}}" nama-pasien="{{$pasien->nama_pasien}}" poliklinik="{{$pasien->poliklinik->nama_poli}}"><i class="fas fa-stethoscope"></i></button>
							<!-- Modal -->
							<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							  <div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
								  <div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle">Pemeriksaan Pasien</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									  <span aria-hidden="true">&times;</span>
									</button>
								  </div>
								  <form method="POST" action="{{ route('pemeriksaan.store') }}">
									 <div class="modal-body">
										  @csrf
										  <div class="form-group">
											<label for="nama_pasien">Nama Pasien</label>
											<input class="form-control" name="nama_pasien" type="text" id="nama_pasien" readonly/>
										  </div>
										  <div class="form-group">
											<label for="poliklinik">Poliklinik</label>
											<input class="form-control" name="poliklinik" type="text" id="poliklinik" readonly/>
										  </div>
										  <div class="form-group">
											<label for="id_dokter">Nama Dokter</label>
											<select id="id_dokter" class="form-control" name="id_dokter" required>
											@if(count($data['dokter']) > 0)
												<option> </option>
												@foreach($data['dokter'] as $dokter)
												<option value="{{$dokter->id}}">{{$dokter->nama_dokter}}</option>
												@endforeach
											@else
												<option>DOKTER BELUM DI ISI</option>
											@endif
											</select>
										  </div>
										  <div class="form-group">
											<label for="penyakit">Penyakit/Gejala</label>
											<textarea class="form-control" placeholder="Flu, Batuk, dll" name="penyakit" type="text" id="penyakit"></textarea>
										  </div>
										  <div class="row">
											<div class="col-md-6">
											  <label for="obat">Obat Bebas</label>
											  <a href="#" id="modalBtn">Add<i class="fas fa-plus-circle"></i></a>
												<div id="simpleModal" class="modal-traversy">
													<div class="modal-traversy-content">
														<div class="modal-traversy-header">
															<span class="closeBtn">&times;</span>
															<h2>Obat</h2>
														</div>
														<div class="modal-traversy-body">
															<div class="row">
																<div class="col-md-6">
																	<h4>Pemilihan obat : </h4>
																</div>
																<div class="col-md-6">
																	<input class="form-control" id="searchObat" type="text" placeholder="Search..">
																</div>
															</div>
															<div class="row">
																@if(count($data['obat-bebas']) > 0)
																	@foreach($data['obat-bebas'] as $key => $obat)
																		<div class="col-md-3 list-obat">
																			<input type="checkbox" name="id_obat[]" class="obat" id="id_obat_{{$obat->id}}" value="{{$obat->id}}" harga-obat="{{$obat->harga_satuan}}"/>
																				<label for="id_obat_{{$obat->id}}"><span id="{{$obat->id}}" class="badge badge-success">{{$obat->nama_obat}}</span></label>
																				<input type="number" id="nama_obat_{{$obat->id}}" class="form-control inputQty qtyObat" style="display: none;" min="1"/>
																		</div>
																	@endforeach
																@else
																	<p> -- ISI OBAT TERLEBIH DAHULU -- </p>
																@endif
															</div>
														</div>
													</div>
												</div>		
											</div>
											<div class="col-md-6">
											  <label for="resep">Resep Dokter</label>
											  <a href="#" id="modalBtnRsp">Add<i class="fas fa-plus-circle"></i></a>
											  <div id="simpleModalRsp" class="modal-traversy">
													<div class="modal-traversy-content">
														<div class="modal-traversy-header">
															<span class="closeBtnRsp">&times;</span>
															<h2>Resep</h2>
														</div>
														<div class="modal-traversy-body">
															<div class="row">
																<div class="col-md-6">
																	<h4>Pemilihan resep : </h4>
																</div>
																<div class="col-md-6">
																	<input class="form-control" id="searchResep" type="text" placeholder="Search..">
																</div>
															</div>
															<div class="row">
																@if(count($data['resep-dokter']) > 0)
																	@foreach($data['resep-dokter'] as $key => $resep)
																		<div class="col-md-3 list-resep">
																			<input type="checkbox" name="id_resep[]" class="resep" id="id_resep_{{$resep->id}}" value="{{$resep->id}}" harga-obat="{{$resep->harga_satuan}}"/>
																				<label for="id_resep_{{$resep->id}}"><span class="badge badge-success">{{$resep->nama_obat}}</span></label>
																				<input type="number" id="nama_obat_{{$resep->id}}" class="form-control inputQty qtyResep" style="display: none;" min="1"/>
																		</div>
																	@endforeach
																@else
																	<p> -- ISI RESEP DOKTER TERLEBIH DAHULU -- </p>
																@endif
															</div>
														</div>
													</div>
												</div>		
											</div>
										  </div>
										  <div class="form-group">
											<label for="keterangan">Keterangan Lanjutan</label>
											<textarea class="form-control" name="keterangan" type="text" id="keterangan"></textarea>
										  </div> 
										  <div class="row">
											<div class="col-md-6 rincian-obat">
											
											</div>
											<div class="col-md-6 rincian-resep">
												
											</div>
										  </div>
										  <div class="form-group">
											<label for="total_harga">Total Harga</label><br>
											<input type="hidden" name="harga_obat" id="harga_obat1"> Rp. <span id="harga_obat" class="badge badge-success" data-toggle="tooltip" data-placement="top" title="Harga obat"></span>
											+ <input class="form-control" name="harga_tambahan" placeholder="50.000" type="text" id="harga_tambahan" data-toggle="tooltip" data-placement="top" title="Biaya pendaftaran, dokter, dll"/>
										  </div>										  
										  <input type="hidden" name="periksa" value="sudah">
										  <input type="hidden" id="id_pasien" name="id_pasien">
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button class="btn btn-primary" type="submit" value="Submit">Submit</button>
									  </div>
								  </form>
								</div>
							  </div>
							</div>
						</div>
					</div>
					@endif
				@endforeach
			@else
				<h2>-- PASIEN KOSONG --</h2>
			@endif
		</div>
		@else
			<div class="privilege-administrator privilege-pemeriksaan">
				<h1>HANYA DAPAT DIAKSES APOTEKER / ADMINISTRATOR</h1>
			</div>
	@endif
	</div>
	
	<script>
	//////// MODAL - Pemeriksaan - Traversy
	// Get DOM Elements
	const modal = document.querySelector('#simpleModal');
	const modalBtn = document.querySelector('#modalBtn');
	const closeBtn = document.querySelector('.closeBtn');
	const modalRsp = document.querySelector('#simpleModalRsp'); // Custom pemeriksaan resep (modal untuk pemeriksaan input resep)
	const modalBtnRsp = document.querySelector('#modalBtnRsp'); // Custom pemeriksaan resep
	const closeBtnRsp = document.querySelector('.closeBtnRsp'); // Custom pemeriksaan resep

	// Events
	modalBtn.addEventListener('click', openModal);
	closeBtn.addEventListener('click', closeModal);
	window.addEventListener('click', outsideClick);
	modalBtnRsp.addEventListener('click', openModalRsp); // Custom pemeriksaan resep
	closeBtnRsp.addEventListener('click', closeModalRsp); // Custom pemeriksaan resep
	window.addEventListener('click', outsideClickRsp);


	// Open
	function openModal() {
	  modal.style.display = 'block';
	}
	function openModalRsp() { // Custom pemeriksaan resep
	  modalRsp.style.display = 'block';
	}

	// Close
	function closeModal() {
	  modal.style.display = 'none';
	}
	function closeModalRsp() { // Custom pemeriksaan resep
	  modalRsp.style.display = 'none';
	}

	// Close If Outside Click
	function outsideClick(e) {
	  if (e.target == modal) {
		modal.style.display = 'none';
	  }
	}
	function outsideClickRsp(e) {
	  if (e.target == modalRsp) {
		modalRsp.style.display = 'none';
	  }
	}
	</script>
@endsection