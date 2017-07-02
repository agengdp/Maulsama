@extends('layouts.frontend')
@section('title')
  {{ $movie->title }}
@endsection

@section('content')
<style type="text/css">
	body::before{
    content: " ";
    position: fixed;
    z-index: -1;
    background-size:cover;
    background-image: url('{{asset("storage/$movie->cover")}}');
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
                            <span class="player__title--judul">
                                {{ $movie->title }}
                            </span>
                        </div>
                        @foreach ($mp4_links as $stream)
                            @if($loop->first)
                                <iframe id="play-frame" src="https://hotload.net/embed/{{ $stream->video_stream_id }}&thumb={{ base64_encode(asset("images/horz/$movie->cover")) }}" frameborder="0" scrolling="no" webkitAllowFullScreen="true" mozallowfullscreen="true" allowFullScreen="true"></iframe>
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
                                <span class="download__header">Download {{ $movie->title }}</span>
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
          <div class="col-xs-12 col-sm-3 col-md-3">
            <div class="cover series__cover">
    					<div class="thumbnail series__thumbnail">
    						<img class="series__image" src="{{ asset('images/vert/'.$movie->cover) }}" alt="{{ $movie->title }}">
    					</div>
    				</div>
          </div>
          <!-- /.col-md-3 -->
          <div class="col-xs-12 col-sm-9 col-md-9">
            <div class="series__header">
              <h1>{{ $movie->title }}</h1>
              <ul class="series-info">
                <li class="series-info__item">Movie</li>
                <li class="series-info__item">{{ $movie->year }}</li>
                <li class="series-info__item">{{ $movie->creator }}</li>
                <li class="series-info__item">{{ $movie->producer }}</li>
              </ul>
              <div class="series-genre">
                Genre :
                @foreach($movie->genre as $genre)
                  {{ $loop->first ? '' : ', ' }}
                  <a class="series-genre__genres" href="{{ route('frontBrowseGenre', $genre->slug) }}">{{ $genre->name }}</a>
                @endforeach
              </div>
              <div class="sinopsis">
                {{ $movie->sinopsis }}
              </div>
              <!-- /.sinopsis -->
            </div>
            <!-- /.series__header -->
          </div>
          <!-- /.col-md-9 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div>
<!-- /.main-content main-content--play -->
@include('public.includes.relatedMovie')
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
