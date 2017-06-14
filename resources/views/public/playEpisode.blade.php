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

<div id="play-episode">
    <div class="container">
        <div id="series" class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1">
                <div class="in-panel">
                    <h1 class="play-title">Eps {{ $episode->episode }} : {{ $episode->judul_episode }}</h1>
                </div>
                <div id="player">
                    <!-- /.in-panel -->

                    <div class="embed-responsive embed-responsive-16by9">
                        @foreach ($mp4_links as $stream)
                            @if($loop->first)
                                {{-- <iframe src="https://hotload.net/embed/{{ $stream->video_stream_id }}&thumb={{ base64_encode(asset("images/horz/$episode->cover")) }}" frameborder="0" scrolling="no" webkitAllowFullScreen="true" mozallowfullscreen="true" allowFullScreen="true"></iframe> --}}
                            @endif
                        @endforeach
                    </div> {{-- /.embed-responsive --}}

                    <div id="video-quality-container" class="clearfix">
                        <ul id="video-quality">    
                            @foreach ($mp4_links as $stream)
                                @if ($loop->first)

                                    <li class="active" data-stream="{{ $stream->video_stream_id }}">{{ $stream->video_quality }}p</li>
                                
                                @continue {{-- dengan ini yang aktif tidak akan dobel --}}
                                
                                @endif
                                
                                <li data-stream="{{ $stream->video_stream_id }}">{{ $stream->video_quality }}p</li>
                            @endforeach

                            <li id="btn-download" class="pull-right"><i class="glyphicon glyphicon-download"></i> Download</li>
                        </ul> {{-- /ul#video-quality --}}
                    </div> {{-- /#video-quality-container --}} 
                </div> {{-- /#player --}}
            </div>
            <!-- /.col-md-10 col-xs-12 -->
        </div>
        <!-- /#series.row -->

        <div id="download-container" class="hidden">
            <div id="download" class="row">
                <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <div class="in-panel">
                        <span class="download-header">Download {{ $episode->judul_episode }}</span>
                        <p>Untuk mendownload silahkan pilih sesuai format dan klik quality di bawah ini.</p>

                        <div class="download-links">
                            @foreach($mp4_links as $video)
                                @if($loop->first)
                                    <span class="format">MP4</span>
                                    <ul>
                                @endif
                                    <li><a href="{{ $video->video_url }}" target="_blank">{{ $video->video_quality }}p</a></li>
                                @if($loop->last)
                                    </ul>
                                @endif
                            @endforeach


                            @foreach($mkv_links as $video)
                                @if($loop->first)
                                    <span class="format">MKV</span>
                                    <ul>
                                @endif
                                    <li><a href="{{ $video->video_url }}" target="_blank">{{ $video->video_quality }}p</a></li>
                                @if($loop->last)
                                    </ul>
                                @endif
                            @endforeach
                        </div>
                        <!-- /.download-links -->
                    </div>
                <!-- /#in-panel -->
                </div>
                <!-- /.col-xs-12 col-md-12 col-md-offset-1 -->
            </div>
            <!-- /#download.row -->
        </div>
        <!-- /#download-container -->
        <div id="info-container">
            <div id="info" class="row">
                <div class="col-xs-12 col-md-3 col-md-offset-1">
                    <div class="in-panel">
                        <div class="thumbnail">
                        <a href="{{ route('frontSeries', $episode->series->slug) }}">
                            <img src="{{ asset('images/vert/'.$episode->series->cover) }}" alt="{{ $episode->series->title }}">
                        </a>
                        </div>
                        <ul class="play-eps-info">
                            <li><a href="{{ route('frontSeries', $episode->series->slug) }}"><strong>{{ $episode->series->title }}</strong></a></li>
                            <li>Released : {{ $episode->series->year }}</li>
                            <li>by : {{ $episode->series->creator }}</li>
                        </ul>
                    </div>
                    <!-- /.in-panel -->
                </div>
                <!-- /.col-xs-12 col-md-10 -->
                <div class="col-md-7">
                    <div id="episode-lainnya" class="in-panel">
                        <h3><i class="glyphicon glyphicon-play-circle"></i> Episode lainnya</h3>
                        <ul class="list-episode-lainnya">
                            @foreach($episode->series->episode as $episode)
                                <li><a href="{{ route('frontPlayEps', [$series->slug, $episode->slug]) }}"><span class="label label-episode-lainnya">Eps. {{ $episode->episode }}</span>{{ $episode->judul_episode }}</a></li>
                            @endforeach
                        </ul>                    
                    </div>
                    <!-- /.in-panel -->
                </div>

            </div>
            <!-- /#info.row -->
        </div>
        <!-- /#info-container -->
    </div>
    <!-- /.container -->
</div> {{-- #/play-episode --}}        
@endsection

@section('jscontainer')
<script type="text/javascript">
jQuery(document).ready(function($) {

    $('#btn-download').click(function(){

        if (!$(this).hasClass('showing')){

            $('#btn-download').addClass('showing');
            $('#download-container').removeClass('hidden');

        }else{

            $('#btn-download').removeClass('showing');
            $('#download-container').addClass('hidden');

        }
    });

});
</script>
@endsection
