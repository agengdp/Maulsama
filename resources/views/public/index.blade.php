@extends('layouts.frontend')

@section('content')

<div class="container-fluid">
	<div class="hero hero-front has-text-centered is-medium">
		<div class="hero-body">
			<div class="container">
				<h1>Maulsama</h1>
				<p class="subtitle">Tempat nonton anime terlengkap subtitle Indonesia!</p>
			</div>
			<!-- /.container -->
		</div>
		<!-- /.hero-body -->
	</div>
</div>
<!-- /.container -->


	<div class="main-content">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<h2 class="header--front">Episode Terbaru</h2>
					<hr class="maul-hr">
				</div>

				@foreach ($episodes as $episode)
					<div class="col-xs-12 col-sm-6 col-md-3 episode">
					    <a href="{{ route('frontPlayEps', [$episode->series->slug, $episode->slug]) }}" class="thumbnail episode__link" alt="{{$episode->judul_episode}}">

									<div class="episode__container">
										<img src="{{ asset("images/horz/$episode->cover") }}" alt="{{$episode->judul_episode}}" class="episode__image">
										<div class="caption episode__caption">
											<span class="episode__episode-ke">Eps {{ $episode->episode }}</span>
										</div>
										<div class="episode__play">
											<span class="episode__play episode__play--text">
												<i class="glyphicon glyphicon-play-circle"></i>
											</span>
										</div>
									</div>

									<div class="episode__info">
										<span class="caption-text episode__judul">{{ str_limit($episode->judul_episode, 30) }}</span>
										<span class="episode__series">{{ $episode->series->title }}</span>
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
