<!-- /.main-content main-content--play -->
<div class="related related--movie">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3 class="header header--related">Anime Movie Menarik Lainnya !</h3>
        @foreach ($movie->genre->random()->media->where('type', 'movie') as $movie)
          <div class="col-xs-6 col-md-2 col-lg-2 related__container">
            <a href="{{ route('frontMovie', $movie->slug) }}" class="thumbnail related__link">
              <img src="{{ asset("images/vert/$movie->cover" ) }}" alt="{{ $movie->title }}" class="related__image">
                <div class="caption related__caption">
                  <span class="caption-text related__judul">{{ $movie->title }}</span>
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
<!-- /.related related--movie -->
