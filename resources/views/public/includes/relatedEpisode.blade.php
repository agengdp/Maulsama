<!-- /.main-content main-content--play -->
<div class="related related--episode">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3 class="header header--related">Anime Menarik Lainnya !</h3>
        @foreach ($series->genre->random()->series as $seri)
          <div class="col-xs-6 col-md-2 col-lg-2 related__container">
            <a href="{{ route('frontSeries', $seri->slug) }}" class="thumbnail related__link">
              <img src="{{ asset("images/vert/$seri->cover" ) }}" alt="{{ $seri->title }}" class="related__image">
                <div class="caption related__caption">
                  <span class="caption-text related__judul">{{ $seri->title }}</span>
                </div> {{-- /.caption --}}
            </a>
          </div>  {{-- .col-xs-6 .col-md-4 .col-lg-3 .image-container --}}
        @endforeach
      </div>
      <!-- /.col-md-12 -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</div>
<!-- /.related related--episode -->
