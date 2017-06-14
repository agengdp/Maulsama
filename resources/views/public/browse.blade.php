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
<div id="browser" class="bodgrad">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3 class="browse-genre-chooser">Pilih Genre :</h3>
				<div class="pull-right">
					{{ $series->links() }}
				</div>
			</div>
			<!-- /.col-md-12 -->
			<div class="col-md-3">
				<div id="filter">
					<ul class="nav nav-pills nav-stacked">
						<li><a href="/browse" class="{{ isActiveRoute('frontBrowse', 'active') }}">Semuanya</a></li>
						@foreach($genres->sortBy('name') as $genre)
							<li><a class="{{ isActiveURL("/browse/$genre->slug") }}" href="{{ route('frontBrowseGenre', $genre->slug) }}">{{ $genre->name }}</a></li>
						@endforeach
					</ul>
				</div>
			</div>
			<!-- /.col-md-3 -->
			<div class="col-md-9">
				<div class="row">
					<div class="col-md-12">
						<h4>Series</h4>
					</div>
					@forelse ($series as $seri)
						<div class="col-xs-6 col-md-4 col-lg-3 image-container">
							<a href="{{ route('frontSeries', $seri->slug) }}" class="thumbnail">
							  <img src="{{ asset("images/vert/$seri->cover" ) }}" alt="{{ $seri->title }}" class="gambar">
							  <div class="caption">
							  	<span class="caption-text">{{ $seri->title }}</span>
							  </div> {{-- /.caption --}}
							</a>
						</div> 
					@empty
						<div class="col-md-12">
							<p>Tidak ada series di kategori ini...</p>
						</div>
					@endforelse
					<div class="col-md-12">
						<h4>Movies</h4>
					</div>
					@forelse ($movies as $movie)
						<div class="col-xs-6 col-md-4 col-lg-3 image-container">
							<a href="{{ route('frontMovie', $movie->slug) }}" class="thumbnail">
							  	<img src="{{ asset("images/vert/$movie->cover") }}" alt="{{ $movie->title }}" class="gambar">
								<div class="caption">
							  		<span class="caption-text">{{ $movie->title }}</span>
							  	</div>
							</a>
						</div>	
					@empty
						<div class="col-md-12">
							<p>Tidak ada movie di kategori ini...</p>
						</div>
					@endforelse
				</div>
			</div>
			<!-- /.col-md-9 -->
		</div>
		<!-- /.row -->
	</div>{{-- ./container --}}
</div> {{-- ./bodgrad --}}

@endsection