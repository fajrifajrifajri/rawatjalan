<div id="sidebar" class="col-md-2">
	<ul class="text-center">
		<a href="/administrator">Dashboard</a>
	</ul>
	<ul><span>Data <i class="fas fa-paste"></i></span>
		<li><i class="fas fa-level-up-alt"></i><a href="/administrator/pasien">Pasien</a></li>
		<li><i class="fas fa-level-up-alt"></i><a href="/administrator/dokter">Dokter</a></li>
		<li><i class="fas fa-level-up-alt"></i><a href="/administrator/obat">Obat</a></li>
	</ul>
	<ul><span>Aplikasi</span>
		<a href="/administrator/pemeriksaan"><li><i class="fas fa-stethoscope"></i>Pemeriksaan</li></a>
		<a href="/administrator/pembayaran"><li><i class="fas fa-money-bill-wave"></i>Pembayaran</li></a>
		<a href="/administrator/laporan"><li><i class="fas fa-align-right"></i>Laporan</li></a>
	</ul>
	<ul>
		<li>
			<i class="fas fa-times"></i><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			@csrf
			</form>
		</li>
	</ul>
</div>