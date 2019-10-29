@extends('layouts.Administrator')

@section('content')
<div id="daftar" class="col-md-10">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card my-md-5">
					<div class="card-header"><a class="mr-md-4" href="javascript:history.back()"><i class="fas fa-arrow-left"></i></a>{{ __('Edit Dokter') }}</div>

					<div class="card-body">
						<form method="POST" action="/administrator/dokter/{{$data['dokter']->id}}" enctype="multipart/form-data">
						@method('PUT')
						@csrf
							<div class="form-group row">
								<label for="nama_dokter" class="col-md-4 col-form-label text-md-right">{{ __('Nama Dokter') }}</label>

								<div class="col-md-6">
									<input id="nama_dokter" type="text" class="form-control @error('nama_dokter') is-invalid @enderror" name="nama_dokter" value="{{ $data['dokter']->nama_dokter }}" required autocomplete="nama_dokter" autofocus>

									@error('nama_dokter')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
							
							<div class="form-group row">
								<label for="poli" class="col-md-4 col-form-label text-md-right">{{ __('Poliklinik') }}</label>

								<div class="col-md-6">
									<select id="poli" class="form-control @error('poli') is-invalid @enderror" name="poli" value="{{ $data['dokter']->id_poliklinik }}" required>
									  <option value="{{ $data['dokter']->id_poliklinik }}">{{ ucfirst($data['dokter']->nama_poli) }}</option>
									  @foreach($data['poli'] as $poli)
										<option value="{{ $poli->id }}">{{ ucfirst($poli->nama_poli)}}</option>
									  @endforeach
									</select>
									@error('poli')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
							
							<div class="form-group row">
								<label for="alamat" class="col-md-4 col-form-label text-md-right">{{ __('Alamat') }}</label>

								<div class="col-md-6">
									<textarea id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" required autocomplete="alamat" autofocus>{{ $data['dokter']->alamat }}</textarea>
									@error('alamat')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
							
							<div class="form-group row">
								<label for="telp" class="col-md-4 col-form-label text-md-right">{{ __('Telp') }}</label>

								<div class="col-md-6">
									<input id="telp" type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" value="{{ $data['dokter']->telp }}" required autocomplete="telp" autofocus>

									@error('telp')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
							
							@if($data['dokter']->foto !== NULL)
							<div class="form-group">
								<div class="offset-md-4 pl-md-2">
									<img src="{{ asset('storage/'.$data['dokter']->foto)}}">
								</div>
							</div>
							@endif
							
							<div class="form-group row">
								<label for="foto" class="col-md-4 col-form-label text-md-right">Foto</label>
								<input type="file" class="col-md-6" name="foto">
								<div>{{ $errors->first('foto') }}</div>
							</div>
							<div class="form-group row mb-0">
								<div class="col-md-6 offset-md-4">
									<button type="submit" class="btn btn-primary">
										{{ __('Ubah') }}
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