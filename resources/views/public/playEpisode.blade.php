@extends('layouts.frontend')
@section('title')
  {{ $series->title }} Episode {{ $episode->episode }} | {{ $episode->judul_episode }}
@endsection

@section('content')

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
                        @forelse ($streams as $stream)
                            @if($loop->first)
                                <iframe id="play-frame" src="https://hotload.net/embed/{{ $stream['url_id'] }}&thumb={{ base64_encode(asset("images/horz/$episode->cover")) }}" frameborder="0" scrolling="no" webkitAllowFullScreen="true" mozallowfullscreen="true" allowFullScreen="true"></iframe>
                            @endif
                        @empty
                          <div class="player__empty">
                            No streaming available
                          </div>
                          <!-- /.player__empty -->
                        @endforelse
                    </div> {{-- /.embed-responsive --}}

                    <div class="in-panel player__quality">
                        <ul class="quality">
                            @forelse ($streams as $stream)
                                  @if ($loop->first)
                                      <li class="quality__list quality__list--active" data-stream="{{ $stream['url_id'] }}">{{ $stream['quality'] }}</li>
                                  @continue
                                  @endif
                                  <li class="quality__list" data-stream="{{ $stream['url_id'] }}">{{ $stream['quality'] }}</li>
                            @empty
                              <li class="quality__list quality__list--active quality__list--empty">No streaming available at the moment</li>
                            @endforelse

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
                                    @if($video->video_type == 'mp4')
                                      @if($loop->first)
                                          <span class="download__links--format">MP4</span>
                                          <ul class="list list--download">
                                      @endif
                                          <li class="list__item list--download__item"><a class="list__link list--download__link" href="{{ $video->video_url }}" target="_blank">{{ $video->video_quality }}</a></li>
                                      @if($loop->last)
                                          </ul>
                                      @endif
                                    @endif
                                  @endforeach

                                  @foreach($mkv_links as $video)
                                    @if($video->video_type == 'mkv')
                                      @if($loop->first)
                                          <span class="download__links--format">MKV</span>
                                          <ul class="list list--download">
                                      @endif
                                          <li class="list__item list--download__item"><a class="list__link list--download__link" href="{{ $video->video_url }}" target="_blank">{{ $video->video_quality }}</a></li>
                                      @if($loop->last)
                                          </ul>
                                      @endif
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
            <div class="col-md-9">
              <span class="play-info play-info--series">
                  Series : <a href="{{ route('frontSeries', $episode->series->slug) }}">{{ $episode->series->title }}</a> | <span class="play-info play-info--episode">Episode : {{ $episode->episode }}</span>
              </span>
                <h1 class="header header--play">{{ $episode->judul_episode }}</h1>
                <div class="main-content__spoiler">
                  @isset($episode->spoiler)
                    {{ $episode->spoiler }}
                  @endisset

                  @empty($episode->spoiler)
                    <p>Kamu telah menyaksikan Episode ke {{ $episode->episode }} yang berjudul {{ $episode->judul_episode }} dari seri {{ $series->title }}</p>
                  @endempty
                </div>
                <!-- /.spoiler -->
                <span class="play-info play-info--episode-lainnya">Episode Lainnya:</span>
                <table class="table table-bordered table-hover table-episode">
                  <tbody>
                    @foreach ($series->episode as $episode)
                      <tr>
                        <td class="text-center" width="36px">{{ $episode->episode }}</td>
                        <td><a href="{{ route('frontPlayEps', [$episode->series->slug, $episode->slug]) }}"><i class="glyphicon glyphicon-play-circle"></i> {{ $episode->judul_episode }}</a></td>
                        <td class="text-center"><a href="{{ route('frontPlayEps', [$episode->series->slug, $episode->slug]) }}" class="btn btn__tonton"><i class="glyphicon glyphicon-play-circle"></i> Tonton</a></td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>

                <div class="comments">
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
            </div>
            <div class="col-md-3">
                <a href="{{ route('frontSeries', $episode->series->slug) }}" class="play-info__link">
                    <img class="thumbnail play-info__image" src="{{ asset('images/vert/'.$episode->series->cover) }}" alt="{{ $episode->series->title }}">
                </a>
                <table class="table table-hover table-underline">
                  <tr>
                    <td><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Published</td>
                    <td>{{ $episode->series->year }}</td>
                  </tr>
                  <tr>
                    <td><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Creator</td>
                    <td>{{ $episode->series->creator }}</td>
                  </tr>
                </table>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div>

@include('public.includes.relatedEpisode');
@endsection

@section('jscontainer')
<script id="dsq-count-scr" src="//maulsama.disqus.com/count.js" async></script>
<script type="text/javascript" src="{{ asset('storage/assets/js/min/main-min.js') }}"></script>
@endsection
