@extends('layouts.Administrator')

@section('content')
<div id="daftar" class="col-md-10">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header"><a class="mr-md-4" href="javascript:history.back()"><i class="fas fa-arrow-left"></i></a>{{ __('Edit Pasien') }}</div>

					<div class="card-body">
						<form method="POST" action="/administrator/pasien/{{$data['pasien']->id}}">
						@method('PUT')
						@csrf
							<div class="form-group row">
								<label for="nama_pasien" class="col-md-4 col-form-label text-md-right">{{ __('Nama Pasien') }}</label>

								<div class="col-md-6">
									<input id="nama_pasien" type="text" class="form-control @error('nama_pasien') is-invalid @enderror" name="nama_pasien" value="{{ $data['pasien']->nama_pasien }}" required autocomplete="nama_pasien" autofocus>

									@error('nama_pasien')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
							
							<div class="form-group row">
								<label for="kelamin" class="col-md-4 col-form-label text-md-right">{{ __('Kelamin') }}</label>

								<div class="col-md-6">
									<select id="kelamin" class="form-control @error('kelamin') is-invalid @enderror" name="kelamin" value="{{ $data['pasien']->kelamin }}" required>
									  <option value="{{ $data['pasien']->kelamin }}">{{ ucfirst($data['pasien']->kelamin) }}</option>
									  <option value="Pria">Pria</option>
									  <option value="Wanita">Wanita</option>
									</select>
									@error('kelamin')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<label for="tanggal_lahir" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Lahir') }}</label>

								<div class="col-md-6">
									<input id="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ $data['pasien']->tanggal_lahir }}" required autocomplete="tanggal_lahir">

									@error('tanggal_lahir')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<label for="alamat" class="col-md-4 col-form-label text-md-right">{{ __('Alamat') }}</label>

								<div class="col-md-6">
									<textarea id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" required autocomplete="alamat" autofocus>{{ $data['pasien']->alamat }}</textarea>
									@error('alamat')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
							
							<div class="form-group row">
								<label for="rekam_medis" class="col-md-4 col-form-label text-md-right">{{ __('Rekam Medis') }}</label>

								<div class="col-md-6">
									<input id="rekam_medis" type="text" class="form-control @error('rekam_medis') is-invalid @enderror" name="rekam_medis" value="{{ $data['pasien']->rekam_medis }}" required autocomplete="rekam_medis" autofocus readonly>

									@error('rekam_medis')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
							
							<div class="form-group row">
								<label for="poliklinik" class="col-md-4 col-form-label text-md-right">{{ __('Poliklinik') }}</label>

								<div class="col-md-6">
									<select id="poliklinik" class="form-control @error('poliklinik') is-invalid @enderror" name="poliklinik" value="{{ $data['pasien']->id_poliklinik }}" required>
									  <option value="{{ $data['pasien']->id_poliklinik }}">{{ ucfirst($data['pasien']->nama_poli) }}</option>
									  @foreach($data['poli'] as $poli)
										<option value="{{ $poli->id }}">{{ ucfirst($poli->nama_poli)}}</option>
									  @endforeach
									</select>
									@error('poliklinik')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
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