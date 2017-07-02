@extends('layouts.frontend')
@section('title')
  {{ $series->title }} Episode {{ $episode->episode }} | {{ $episode->judul_episode }}
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

<div class="hero hero--play">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="player">
                    <div class="embed-responsive embed-responsive-16by9 player__embed">
                        <div class="player__title">
                            <span class="player__title--episode">
                                Episode {{ $episode->episode }}
                            </span>
                            <span class="player__title--judul">
                                {{ $episode->judul_episode }}
                            </span>
                        </div>
                        @foreach ($mp4_links as $stream)
                            @if($loop->first)
                                <iframe id="play-frame" src="https://hotload.net/embed/{{ $stream->video_stream_id }}&thumb={{ base64_encode(asset("images/horz/$episode->cover")) }}" frameborder="0" scrolling="no" webkitAllowFullScreen="true" mozallowfullscreen="true" allowFullScreen="true"></iframe>
                            @endif
                        @endforeach
                    </div> {{-- /.embed-responsive --}}

                    <div class="in-panel player__quality">
                        <ul class="quality">
                            @foreach ($mp4_links as $stream)
                                @if ($loop->first)

                                    <li class="quality__list quality__list--active" data-stream="{{ $stream->video_stream_id }}">{{ $stream->video_quality }}p</li>

                                @continue {{-- dengan ini yang aktif tidak akan dobel --}}

                                @endif

                                <li class="quality__list" data-stream="{{ $stream->video_stream_id }}">{{ $stream->video_quality }}p</li>
                            @endforeach

                            <li id="btn-download" class="btn btn--download pull-right"><i class="glyphicon glyphicon-download"></i> Download</li>
                        </ul> {{-- /ul#video-quality --}}
                    </div> {{-- /.player__quality --}}

                    <div id="download-container" class="hidden">
                        <div class="download">
                            <div class="in-panel in-panel--download">
                                <span class="download__header">Download {{ $episode->judul_episode }}</span>
                                <p>Untuk mendownload silahkan pilih sesuai format dan klik quality di bawah ini.</p>

                                <div class="download__links">
                                    @foreach($mp4_links as $video)
                                        @if($loop->first)
                                            <span class="download__links--format">MP4</span>
                                            <ul class="list list--download">
                                        @endif
                                            <li class="list__item list--download__item"><a class="list__link list--download__link" href="{{ $video->video_url }}" target="_blank">{{ $video->video_quality }}p</a></li>
                                        @if($loop->last)
                                            </ul>
                                        @endif
                                    @endforeach


                                    @foreach($mkv_links as $video)
                                        @if($loop->first)
                                            <span class="download__links--format">MKV</span>
                                            <ul class="list list--download">
                                        @endif
                                            <li class="list__item list--download__item"><a class="list__link list--download__link" href="{{ $video->video_url }}" target="_blank">{{ $video->video_quality }}p</a></li>
                                        @if($loop->last)
                                            </ul>
                                        @endif
                                    @endforeach
                                </div>
                                <!-- /.download-links -->
                            </div>
                        <!-- /#in-panel -->
                        </div>
                        <!-- /#download.row -->
                    </div>
                    <!-- /#download-container -->

                </div> {{-- /.player --}}
            </div> {{-- ./col-md-10 --}}
        </div> {{-- ./row --}}
    </div>{{-- ./container --}}
</div>
<div class="main-content main-content--play">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <a href="{{ route('frontSeries', $episode->series->slug) }}" class="play-info__link">
                    <img class="thumbnail play-info__image" src="{{ asset('images/vert/'.$episode->series->cover) }}" alt="{{ $episode->series->title }}">
                </a>
            </div>
            <div class="col-md-9">
                <h1 class="header header--play">{{ $episode->judul_episode }}</h1>
                <span class="play-info play-info--series">
                    <a href="{{ route('frontSeries', $episode->series->slug) }}">{{ $episode->series->title }}</a>
                </span>
                <span class="play-info play-info--episode">Episode : {{ $episode->episode }}</span>
                <span class="play-info play-info--episode-lainnya">Episode Lainnya:</span>
                <ul class="in-panel list list--episode-lain">
                    @foreach($episode->series->episode as $episode)
                        <li class="list__item list--episode-lain__item">
                            <a href="{{ route('frontPlayEps', [$episode->series->slug, $episode->slug]) }}" class="list__link list--episode-lain__link"><span class="list--episode-lain__episode">Episode {{ $episode->episode }}</span> {{ $episode->judul_episode }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div>
@include('public.includes.relatedEpisode');
@endsection

@section('jscontainer')
<script type="text/javascript" src="http://localhost:5757/storage/assets/js/min/main-min.js"></script>
@endsection
