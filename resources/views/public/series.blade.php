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
<div class="front-series" >
	<div class="container">
		<div id="series-container" class="row">
			<div class="col-xs-12 col-sm-3 col-md-3">
				<div class="cover">
					<div class="thumbnail">
						<img src="{{asset("storage/$series->cover")}}">
					</div>
				</div>
			</div> {{-- ./col-md-3 --}}
			<div id="series-header" class="col-xs-12 col-sm-9 col-md-9">
				<h1>{{$series->title}}</h1>
				<ul id="series-info">
					<li>Series</li>
					<li>{{$series->year}}</li>
					<li>{{$series->creator}}</li>
					<li>{{$series->producer}}</li>
				</ul>

				<div id="genre">
					Genre :
					@foreach($series->genre as $genre)
						{{ $loop->first ? '' : ', ' }}
						{{ $genre->name }}
					@endforeach
				</div>

				<div id="sinopsis">
					<p>{{$series->sinopsis}}</p>
				</div>
			</div> {{-- #/series-header --}}
		</div> {{-- ./row --}}

		<div id="episode-container" class="row">
			<div class="col-md-12">
			<h2>Episode</h2>
				<div class="episode">
					<ul class="list-episode">
						@foreach($series->episode->sortByDesc('episode') as $episode)
							<li>
								<div class="media epiclick" data-key="{{$episode->id}}">
								  <div class="media-left">
								    <div class="label-episode">
								      {{$episode->episode}}
								    </div>
								  </div>
								  <div class="media-body">
								    <h4 class="judul">{{$episode->judul_episode}}</h4>
								  </div>
								</div>
								<div class="spoiler spoil-{{$episode->id}} hidden">

									<div class="row">
										<div class="col-xs-12 col-sm-2 col-md-2">
											<div class="thumbnail spoiler-img">
												<img src="{{ asset("images/eps/$episode->cover") }}" alt="{{ $episode->judul_episode }}" />
											</div>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-8">
											<p class="spoiler-desc">{{ $episode->spoiler }}</p>
										</div>
										<div class="col-xs-12 col-sm-2 col-md-2">
											<div class="play-button-container">
												<a href="{{ route('frontPlayEps', [$series->slug, $episode->slug]) }}" class="btn btn-play-episode"><i class="glyphicon glyphicon-play"></i></a>
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
