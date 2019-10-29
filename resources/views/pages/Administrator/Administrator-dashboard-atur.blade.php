@extends('layouts.Administrator')

@section('content')
<div id="daftar" class="col-md-10">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div id="atur" class="card">
					<div class="card-header">{{ __('Atur user') }}</div>
					<div class="card-body">
						@if(count($user) > 0)
							<ul>
							@foreach($user as $users)
								<li>{{$users->username}} <span class="badge badge-success">{{strtoupper($users->roles)}}</span>
									<div class="aksi">
										<form action="/administrator/ubah-user/{{$users->id}}/edit" method="POST">
										@csrf
										@method('GET')
											<button type="submit" class="btn btn-link"><i class="fas fa-pencil-alt"></i></button>
										</form>
										<form action="/administrator/ubah-user/{{$users->id}}" method="POST">
										@csrf
										@method('DELETE')
											<button type="submit" onClick="return confirm('Hapus user tersebut?')" class="btn btn-link"><i class="fas fa-times text-danger"></i></button>
										</form>
									</div>
								</li>
							@endforeach
							</ul>
						@else
							<p>Tidak ada user</p>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection