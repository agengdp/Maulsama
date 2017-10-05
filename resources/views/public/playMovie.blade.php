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
                        @foreach ($streams as $stream)
                            @if($loop->first)
                                <iframe id="play-frame" src="https://hotload.net/embed/{{ $stream['url_id'] }}&thumb={{ base64_encode(asset("images/horz/$movie->cover")) }}" frameborder="0" scrolling="no" webkitAllowFullScreen="true" mozallowfullscreen="true" allowFullScreen="true"></iframe>
                            @endif
                        @endforeach
                    </div> {{-- /.embed-responsive --}}

                    <div class="in-panel player__quality">
                        <ul class="quality">
                            @foreach ($streams as $stream)
                                @if ($loop->first)

                                    <li class="quality__list quality__list--active" data-stream="{{ $stream['url_id'] }}">{{ $stream['quality'] }}</li>

                                @continue {{-- dengan ini yang aktif tidak akan dobel --}}

                                @endif

                                <li class="quality__list" data-stream="{{ $stream['url_id'] }}">{{ $stream['quality'] }}</li>
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
                                            <li class="list__item list--download__item"><a class="list__link list--download__link" href="{{ $video->video_url }}" target="_blank">{{ $video->video_quality }}</a></li>
                                        @if($loop->last)
                                            </ul>
                                        @endif
                                    @endforeach


                                    @foreach($mkv_links as $video)
                                        @if($loop->first)
                                            <span class="download__links--format">MKV</span>
                                            <ul class="list list--download">
                                        @endif
                                            <li class="list__item list--download__item"><a class="list__link list--download__link" href="{{ $video->video_url }}" target="_blank">{{ $video->video_quality }}</a></li>
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

<div class="main-content main-content--play main-content--play__movie">
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

<div class="comments comments__movie">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <div id="disqus_thread"></div>
        <script>

        /**
        *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
        *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
        /*
        var disqus_config = function () {
        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };
        */
        (function() { // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        s.src = 'https://maulsama.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
        })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

      </div>
      <!-- /.col-md-10 col-md-offset-1 -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</div>
<!-- /.comments -->
@include('public.includes.relatedMovie')
@endsection

@section('jscontainer')
<script id="dsq-count-scr" src="//maulsama.disqus.com/count.js" async></script>
<script type="text/javascript" src="http://localhost:5757/storage/assets/js/min/main-min.js"></script>
@endsection
