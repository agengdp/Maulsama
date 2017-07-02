@extends('layouts.frontend')
@section('title')
	{{$series->title}}
@endsection

@section('content')
<style type="text/css">
	body::before{
    content: " ";
    position: fixed;
    z-index: -1;
    background-size:cover;
    background-image: url('{{asset("storage/$series->cover")}}');
    background-position:center top;
    display: block;
    width: 100%;
    height: 100vh;
    opacity: 0.5;
    filter: blur(30px) ;
    -webkit-filter: blur(30px) ;
}
</style>
<div class="main-content main-content--series" >
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-3 col-md-3">
				<div class="cover series__cover">
					<div class="thumbnail series__thumbnail">
						<img class="series__image" src="{{asset("storage/$series->cover")}}">
					</div>
				</div>
			</div> {{-- ./col-md-3 --}}
			<div class="col-xs-12 col-sm-9 col-md-9">
				<div class="series__header">
					<h1>{{$series->title}}</h1>
					<ul class="series-info">
						<li class="series-info__item">Series</li>
						<li class="series-info__item">{{$series->year}}</li>
						<li class="series-info__item">{{$series->creator}}</li>
						<li class="series-info__item">{{$series->producer}}</li>
					</ul>

					<div class="series-genre">
						Genre :
						@foreach($series->genre as $genre)
							{{ $loop->first ? '' : ', ' }}
							<a class="series-genre__genres" href="{{ route('frontBrowseGenre', $genre->slug) }}">{{ $genre->name }}</a>
						@endforeach
					</div>

					<div class="sinopsis">
						<p>{{$series->sinopsis}}</p>
					</div>
				</div>
				<!-- /.series__header -->
			</div> {{-- ./col-xs-12 col-sm-9 col-md-9 --}}
		</div> {{-- ./row --}}

		<div class="row">
			<div class="col-md-12">
			<h2 class="header--episode">Daftar Episode</h2>
				<div class="list-episode-container">
					<ul class="list-episode">
						@foreach($series->episode->sortByDesc('episode') as $episode)
							<li class="list-episode__item">
								<div class="media list-episode__item--epiclick epiclick" data-key="{{$episode->id}}">
								  <div class="media-left">
								    <div class="label-episode list-episode__episode">
								      {{$episode->episode}}
								    </div>
								  </div>
								  <div class="media-body list-episode__body">
								    <h4 class="list-episode__judul">{{$episode->judul_episode}}</h4>
								  </div>
								</div>
								<div class="spoiler spoil-{{$episode->id}} hidden">
									<div class="row">
										<div class="col-xs-12 col-sm-2 col-md-2">
											<div class="thumbnail spoiler__image-container">
												<img class="spoiler__image" src="{{ asset("images/eps/$episode->cover") }}" alt="{{ $episode->judul_episode }}" />
											</div>
										</div>
										<div class="col-xs-12 col-sm-10 col-md-10">
											<span class="spoiler__eps">Episode : {{ $episode->episode }}</span>
											<p class="spoiler__desc">{{ $episode->spoiler }}</p>
											<div class="spoiler__button-container">
												<a href="{{ route('frontPlayEps', [$series->slug, $episode->slug]) }}" class="btn btn--spoiler"><i class="glyphicon glyphicon-play"></i></a>
											</div>
										</div>
									</div>

								</div>
							</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>

	</div> {{-- ./container --}}
</div> {{-- ./front-series --}}
@endsection

@section('jscontainer')
<script type="text/javascript">
jQuery(document).ready(function($) {

	$('.epiclick').click(function(){

		if (!$(this).hasClass('expanded')){
			var btn = $(this);
			var	key = $(this).attr('data-key');

			$('.epiclick').removeClass('expanded');
			$('.spoiler').addClass('hidden');

			btn.addClass('expanded');
			$('.spoil-' + key).removeClass('hidden');
		}else{
			$('.spoiler').addClass('hidden');
			$('.epiclick').removeClass('expanded');
		}
	});

});
</script>
@endsection
