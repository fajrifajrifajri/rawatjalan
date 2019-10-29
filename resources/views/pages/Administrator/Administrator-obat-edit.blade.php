@extends('layouts.Administrator')

@section('content')
<div id="daftar" class="col-md-10">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header"><a class="mr-md-4" href="javascript:history.back()"><i class="fas fa-arrow-left"></i></a>{{ __('Edit Obat') }}</div>

					<div class="card-body">
						<form method="POST" action="/administrator/obat/{{$medicine->id}}">
						@method('PUT')
						@csrf
							<div class="form-group row">
								<label for="nama_obat" class="col-md-4 col-form-label text-md-right">{{ __('Nama Obat') }}</label>

								<div class="col-md-6">
									<input id="nama_obat" type="text" class="form-control @error('nama_obat') is-invalid @enderror" name="nama_obat" value="{{ $medicine->nama_obat }}" required autocomplete="nama_obat" autofocus>

									@error('name')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
							
							<div class="form-group row">
								<label for="jenis_obat" class="col-md-4 col-form-label text-md-right">{{ __('Jenis Obat') }}</label>

								<div class="col-md-6">
									<input id="jenis_obat" type="text" class="form-control @error('jenis_obat') is-invalid @enderror" name="jenis_obat" value="{{ $medicine->jenis_obat }}" required autocomplete="jenis_obat" autofocus>

									@error('jenis_obat')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
							
							<div class="form-group row">
								<label for="satuan" class="col-md-4 col-form-label text-md-right">{{ __('Satuan') }}</label>

								<div class="col-md-6">
									<input id="satuan" type="text" class="form-control @error('satuan') is-invalid @enderror" name="satuan" value="{{ $medicine->satuan }}" required autocomplete="satuan" autofocus>

									@error('satuan')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
							
							<div class="form-group row">
								<label for="harga_satuan" class="col-md-4 col-form-label text-md-right">{{ __('Harga Satuan') }}</label>

								<div class="col-md-6">
									<input id="harga_satuan" type="text" class="form-control @error('harga_satuan') is-invalid @enderror" name="harga_satuan" value="{{ $medicine->harga_satuan }}" required autocomplete="harga_satuan" autofocus>

									@error('harga_satuan')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>

							<div class="form-group row mb-0">
								<div class="col-md-6 offset-md-4">
									<button type="submit" class="btn btn-primary">
										{{ __('Register') }}
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection