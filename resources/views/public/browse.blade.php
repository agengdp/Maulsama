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
			<div class="col-sm-12 col-md-8 col-md-offset-2">
				<div class="in-panel">
					{{ Form::open(array('route' => 'frontBrowse', 'method' => 'get')) }}
						<div class="input-group">
							{{ Form::text('s','', array('class' => 'form-control browse-cari', 'placeholder' => 'Masukkan judul anime atau keyword disini')) }}
							<span class="input-group-btn">
								{{ Form::submit('Cari', array('class' => 'btn btn-cari')) }}
							</span>

						</div>
					{{ Form::close() }}
				</div> {{-- /.in-panel --}}
			</div> {{-- /.col-sm-12 .col-md-8 .col-md-offset-2 --}}
			<div class="col-md-12">
				<h3 class="browse-genre-chooser">Pilih Genre :</h3>
				<div class="pull-right">
					@if(isset($s))
						{{ $series->appends(['s' => $s])->links() }}
					@else
						{{ $series->links() }}
					@endif
				</div>{{-- /.pull-right --}}
			</div>{{-- /.col-md-12 --}}

			<div class="col-md-3">
				<div id="filter">
					<ul class="nav nav-pills nav-stacked">
						<li><a href="/browse" class="{{ isActiveRoute('frontBrowse', 'active') }}">Semuanya</a></li>
						@foreach($genres->sortBy('name') as $genre)
							<li><a class="{{ isActiveURL("/browse/$genre->slug") }}" href="{{ route('frontBrowseGenre', $genre->slug) }}">{{ $genre->name }}</a></li>
						@endforeach
					</ul>
				</div>{{-- /#filter --}}
			</div>{{-- /.col-md-3 --}}

			<div class="col-md-9">

				<div class="row">
					@if(count($series) > 0)
						<div class="col-md-12">
							<h4>Series</h4>
						</div>
					@endif
					<div class="clearfix">
						@forelse ($series as $seri)
							<div class="col-xs-6 col-md-4 col-lg-3 image-container">
								<a href="{{ route('frontSeries', $seri->slug) }}" class="thumbnail">
								  <img src="{{ asset("images/vert/$seri->cover" ) }}" alt="{{ $seri->title }}" class="gambar">
								  <div class="caption">
								  	<span class="caption-text">{{ $seri->title }}</span>
								  </div> {{-- /.caption --}}
								</a>
							</div>  {{-- .col-xs-6 .col-md-4 .col-lg-3 .image-container --}}
						@empty
							<div class="col-md-12">
								<p>Tidak ada series...</p>
							</div>
						@endforelse
					</div> {{-- /.clearfix --}}

					@if(count($movies) > 0)
						<div class="col-md-12">
							<h4>Movies</h4>
						</div> {{-- /.col-md-12 --}}
					@endif

					<div class="clearfix">
						@forelse ($movies as $movie)
							<div class="col-xs-6 col-md-4 col-lg-3 image-container">
								<a href="{{ route('frontMovie', $movie->slug) }}" class="thumbnail">
								  	<img src="{{ asset("images/vert/$movie->cover") }}" alt="{{ $movie->title }}" class="gambar">
									<div class="caption">
								  		<span class="caption-text">{{ $movie->title }}</span>
								  	</div> {{-- /.caption --}}
								</a>
							</div> {{-- .col-xs-6 .col-md-4 .col-lg-3 .image-container --}}	
						@empty
							<div class="col-md-12">
								<p>Tidak ada movie...</p>
							</div> {{-- /.col-md-12 --}}
						@endforelse
					</div> {{-- /.clearfix --}}

				</div> {{-- /.row --}}
			</div> {{-- /.col-md-9 --}}
		</div> {{-- /.row --}}
	</div>{{-- ./container --}}
</div> {{-- ./bodgrad --}}

@endsection