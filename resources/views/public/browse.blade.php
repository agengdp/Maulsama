@extends('layouts.frontend')
@section('title', 'Jelajahi Koleksi Anime Subtitle Indonesia')

@section('content')
<div class="headnod">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Tonton koleksi anime kesukaanmu !</h1>
				<p>Yuk nikmatin nonton anime terbaru disini.</p>
			</div> {{-- ./col-md-12 --}}
		</div> {{-- ./row --}}
	</div>{{-- ./container --}}
</div>


<div class="bodgrad">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2  class="headlist">Koleksi Series Terbaru</h2>
			</div> {{-- ./col-md-12 --}}

@for ($i = 0; $i < 18; $i++)
	<div class="col-xs-6 col-md-4 col-lg-2">
		<a href="#" class="thumbnail">
		  <img src="http://placehold.it/250x375" alt="...">
		</a>
	</div>    
@endfor
		</div> {{-- ./row --}}
		<div class="row">
			<div class="col-md-12">
				<div class="container-more">
					<a href="#" class="btn btn-cok">Lihat Lebih Banyak Series</a>
				</div> {{-- ./container-more --}}
			</div> {{-- ./col-md-12 --}}
		</div> {{-- ./row --}}
	</div>{{-- ./container --}}
</div> {{-- ./bodgrad --}}

<div class="torgrad">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="headlist">Koleksi Movies Terbaru</h2>
			</div> {{-- ./col-md-12 --}}

@for ($i = 0; $i < 18; $i++)
	<div class="col-xs-6 col-md-4 col-lg-2">
		<a href="#" class="thumbnail">
		  <img src="http://placehold.it/250x375" alt="...">
		</a>
	</div>
@endfor
		</div> {{-- ./row --}}

		<div class="row">
			<div class="col-md-12">
				<div class="container-more">
					<a href="#" class="btn btn-cok">Lihat Lebih Banyak Movies</a>
				</div> {{-- ./container-more --}}
			</div> {{-- ./col-md-12 --}}
		</div> {{-- ./row --}}

	</div>{{-- ./container --}}
</div> {{-- ./bodgrad --}}

@endsection