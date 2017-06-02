@extends('layouts.frontend')
@section('title', 'Animestream')

@section('content')
	<div class="front-hero">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Animestream</h1>
					<p>Tempat nonton anime terlengkap subtitle Indonesia!</p>
				</div>
@foreach($series as $seri)
	<div class="col-xs-6 col-md-4 col-lg-2">
		<a href="{{ route('frontSeries', $seri->id) }}" class="thumbnail">
		  <img src="{{ asset("images/vert/$seri->cover") }}" alt="{{$seri->title}}">
		</a>
	</div>
@endforeach
			</div> {{-- ./row --}}
		</div> {{-- /.container --}}
	</div>{{-- /.front-hero --}}
	
	<div class="bodgrad">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="headlist">On-going anime</h2>
				</div>

@foreach ($episodes as $episode)
	<div class="col-xs-6 col-md-3">
	    <a href="#" class="thumbnail">
	      <img src="{{ asset("images/horz/$episode->cover") }}" alt="{{$episode->judul_episode}}">

		<div class="caption">
			{{$episode->judul_episode}}
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
				  	<div class="form-group lebih-banyak">
						Masih banyak lagi lo koleksinya , yuk <a href="{{route('frontBrowse')}}" class="btn btn-cok btn-more">Lihat Lebih Banyak Lagi -></a>
					</div> {{-- ./form-group --}}
				</div> {{-- ./col-md-12 --}}
			</div> {{-- ./row --}}
		</div> {{-- ./container --}}
	</div> {{-- ./sechead --}}
@endsection