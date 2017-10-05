@extends('layouts.frontend')
@section('title')
	{{ $browse_title }}
@endsection

@section('content')
<div class="hero hero--browse">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Tonton koleksi anime kesukaanmu !</h1>
				<p class="subhead">Yuk nikmatin nonton anime terbaru disini.</p>
			</div> {{-- ./col-md-12 --}}
		</div> {{-- ./row --}}
	</div>{{-- ./container --}}
</div>
<div class="main-content main-content--browse">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-10 col-md-offset-1">
				<div class="in-panel">
					{{ Form::open(array('route' => 'frontBrowse', 'method' => 'get')) }}
						<div class="input-group in-form">
							{{ Form::text('s','', array('class' => 'form-control in-form__input in-form__input--browse', 'placeholder' => 'Masukkan judul anime atau keyword disini')) }}
							<span class="input-group-btn">
								{{ Form::submit('Cari', array('class' => 'btn btn--cari')) }}
							</span>

						</div>
					{{ Form::close() }}
				</div> {{-- /.in-panel --}}
			</div> {{-- /.col-sm-12 .col-md-8 .col-md-offset-2 --}}

			<div class="col-md-12 genre-chooser">
				<h3 class="header--browse">Pilih Genre :</h3>
				<div class="pull-right">
					@if(isset($s))
						{{ $series->appends(['s' => $s])->links() }}
					@else
						{{ $series->links() }}
					@endif
				</div>{{-- /.pull-right --}}
			</div>{{-- /.col-md-12 --}}

			<div class="col-md-3">
				<div class="filter">
					<ul class="nav nav-pills nav-stacked list__filter">
						<li class="list__item list__item--filter">
							<a href="/browse" class="list__link list__link--filter {{ isActiveRoute('frontBrowse', 'list__link--active') }}">Semuanya</a>
						</li>
						@foreach($genres->sortBy('name') as $genre)
							<li class="list__item list__item--filter">
								<a class="list__link list__link--filter {{ isActiveURL("/browse/$genre->slug", 'list__link--active') }}" href="{{ route('frontBrowseGenre', $genre->slug) }}">{{ $genre->name }}</a>
							</li>
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
							<div class="col-xs-6 col-md-4 col-lg-3 episode episode--browse">
								<a href="{{ route('frontSeries', $seri->slug) }}" class="thumbnail episode__link episode--browse__link">
								  <img src="{{ asset("images/vert/$seri->cover" ) }}" alt="{{ $seri->title }}" class="episode__image episode--browse__image">
								  <div class="caption episode__caption episode--browse__caption">
								  	<span class="caption-text episode__judul episode--browse__judul">{{ $seri->title }}</span>
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
							<div class="col-xs-6 col-md-4 col-lg-3 episode episode--browse">
								<a href="{{ route('frontMovie', $movie->slug) }}" class="thumbnail episode__link episode--browse__link">
								  	<img src="{{ asset("images/vert/$movie->cover") }}" alt="{{ $movie->title }}" class="episode__image episode--browse__image">
									<div class="caption episode__caption episode--browse__caption">
								  		<span class="caption-text episode_judul episode--browse__judul">{{ $movie->title }}</span>
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
