<nav>
	<div class="d-flex">
		<a href="/" class="mr-auto">
			<img src="{{ asset('img/Logo.png') }}"/>
		</a>
		<div id="trapezoid">
			<hr><hr><hr>
			{{ strtoupper(Auth::user()->roles) }}
		</div>
	</div>
</nav>