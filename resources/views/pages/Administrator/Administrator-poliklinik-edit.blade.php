@extends('layouts.Administrator')

@section('content')
<div id="daftar" class="col-md-10">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header"><a class="mr-md-4" href="javascript:history.back()"><i class="fas fa-arrow-left"></i></a>{{ __('Edit Poliklinik') }}</div>

					<div class="card-body">
						<form method="POST" action="/administrator/poliklinik/{{$poli->id}}">
						@method('PUT')
						@csrf
						
							<div class="form-group row">
								<label for="nama_poli" class="col-md-4 col-form-label text-md-right">{{ __('Nama Poliklinik') }}</label>

								<div class="col-md-6">
									<input id="nama_poli" type="text" class="form-control @error('nama_poli') is-invalid @enderror" name="nama_poli" value="{{ $poli->nama_poli }}" required autocomplete="nama_poli" autofocus>

									@error('nama_poli')
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