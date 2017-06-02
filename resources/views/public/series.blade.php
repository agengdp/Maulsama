@extends('layouts.frontend')
@section('title')
	{{$series->title}}
@endsection

@section('content')
<style type="text/css">
	body:before{
    content: " ";
    position: fixed;
    z-index: -1;
    background-size:cover;
    background-image: url('{{asset("storage/$series->cover")}}');
    background-position:center top;
    display: block;
    width: 100%;
    height: 100vh;
    opacity: 0.7;
    filter: blur(30px) ;
    -webkit-filter: blur(30px) ;
}
</style>
<div class="front-series" >
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="thumbnail">
					<img src="{{asset("storage/$series->cover")}}">
				</div>
			</div> {{-- ./col-md-3 --}}
			<div class="col-md-9">
				<h1>{{$series->title}}</h1>
				<ul class="series-info">
					<li>Series</li>
					<li>{{$series->year}}</li>
					<li>{{$series->creator}}</li>
					<li>{{$series->producer}}</li>
				</ul>

				{{$series->genre}}

				<div class="sinopsis">
					<p>{{$series->sinopsis}}</p>					
				</div>
			</div> {{-- ./col-md-3 --}}
		</div> {{-- ./row --}}
	</div> {{-- ./container --}}
</div> {{-- ./front-series --}}
@endsection