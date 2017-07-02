@extends('layouts.frontend')
@section('title', 'Animestream')

@section('content')
	<div class="hero">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1>Animestream</h1>
					<p>Tempat nonton anime terlengkap subtitle Indonesia!</p>
				</div>
				@foreach($series as $seri)
					<div class="col-xs-6 col-md-4 col-lg-2 hero__image-container">
						<a href="{{ route('frontSeries', $seri->slug) }}" class="thumbnail hero__link">
						  <img src="{{ asset("images/vert/$seri->cover") }}" alt="{{$seri->title}}" class="hero__image">
						  <div class="caption hero__caption">
						  	<span class="caption-text hero__caption-text">{{ $seri->title }}</span>
						  </div> {{-- /.caption --}}
						</a>
					</div>
				@endforeach
			</div> {{-- ./row --}}
		</div> {{-- /.container --}}
	</div>{{-- /.hero --}}

	<div class="main-content">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<h2 class="header--front">Episode Terbaru</h2>
				</div>

				@foreach ($episodes as $episode)
					<div class="col-xs-6 col-md-3 episode">
					    <a href="{{ route('frontPlayEps', [$episode->series->slug, $episode->slug]) }}" class="thumbnail episode__link" alt="{{$episode->judul_episode}}">

					      	<div class="episode__container">
						      	<img src="{{ asset("images/horz/$episode->cover") }}" alt="{{$episode->judul_episode}}" class="episode__image">

								<div class="caption episode__caption">
									<span class="caption-text episode__judul">{{ str_limit($episode->judul_episode, 30) }}</span>
									<span class="episode__series">{{ $episode->series->title }}</span>
									<span class="episode__episode-ke">Eps {{ $episode->episode }}</span>
								</div>
							</div>

							<div class="episode__play">
								<span class="play__text">
									<i class="glyphicon glyphicon-play-circle"></i>
								</span>
							</div>
					    </a>
					</div>
				@endforeach

			</div> {{-- /.row --}}
		</div> {{-- /.container --}}
	</div> {{-- /.bodgrad --}}

	<div class="sechead">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
				  	<div class="form-group sechead__lebih-banyak">
						Masih banyak lagi lo koleksinya , yuk <a href="{{route('frontBrowse')}}" class="btn btn__sechead">Lihat Lebih Banyak Lagi -></a>
					</div> {{-- ./form-group --}}
				</div> {{-- ./col-md-12 --}}
			</div> {{-- ./row --}}
		</div> {{-- ./container --}}
	</div> {{-- ./sechead --}}
@endsection
