<div class="container">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header logo">
	  <button type="button" class="navbar-toggle collapsed logo__toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	    <span class="sr-only">Toggle navigation</span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand logo__name" href="/">Maulsama</a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

		<ul class="nav navbar-nav navkiri">
			<li class="dropdown navkiri__item">
		      <a href="#" class="dropdown-toggle navkiri__link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-th-list"></i> Series <span class="caret"></span></a>
				<ul class="dropdown-menu nav-menu">
					<li class="nav-menu__item">
						<div class="yamm-content">
							<ul class="media-list navbar-media">
								@foreach($navSeries as $navSeri)
			                        <li class="media navbar-media__item">
			                        	<a href="{{ route('frontSeries', $navSeri->slug) }}" alt="{{ $navSeri->title }}" class="navbar-media__link">
				                        	<div class="media-body navbar-media__body">
				                            	<h4 class="media-heading navbar-media__heading">{{ $navSeri->title }}</h4>
				                            	{{ str_limit($navSeri->sinopsis, 300) }}
				                        	</div>
				                        	<div class="media-right navbar-media__right">
				                        		<img src="{{ asset('images/nav/'.$navSeri->cover) }}" alt="{{ $navSeri->title }}" class="media-object navbar-media__image">
				                        	</div>
				                        </a>
			                        </li>
								@endforeach
		                      </ul>
						</div>
						<!-- /.yamm-content -->
					</li>
				</ul>
			</li>
			<li class="dropdown navkiri__item">
		      <a href="#" class="dropdown-toggle navkiri__link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-film"></i> Movies <span class="caret"></span></a>
				<ul class="dropdown-menu nav-menu">
					<li class="nav-menu__item">
						<div class="yamm-content">
							<ul class="media-list navbar-media">
								@foreach($navMovies as $navMovie)
			                        <li class="media navbar-media__item">
			                        	<a href="{{ route('frontMovie', $navMovie->slug) }}" class="navbar-media__link">
				                          	<div class="media-body navbar-media__body">
				                            	<h4 class="media-heading navbar-media__heading">{{ $navMovie->title }}</h4>
				                            	{{ str_limit($navMovie->sinopsis, 200) }}
				                          	</div>
				                        	<div class="media-right navbar-media__right">
				                        		<img src="{{ asset('images/nav/'.$navMovie->cover) }}" alt="{{ $navMovie->title }}" class="media-object navbar-media__image">
				                        	</div>
				                        </a>
			                        </li>
								@endforeach
		                      </ul>
						</div>
						<!-- /.yamm-content -->
					</li>
				</ul>
			</li>
		</ul>
		<ul class="nav navbar-nav navbar-right navkanan">
			<li class="dropdown navkanan__item">
		  		<a href="#" class="dropdown-toggle navkanan__link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" alt="Tampilkan Genre !"><i class="glyphicon glyphicon-th"></i><span class="nav-genre__label"> Browse Genre</span></a>
				<ul class="dropdown-menu nav-genre">
						<li class="nav-genre__item"><a class="nav-genre__link" href="/browse" alt="Tampilkan semuanya">Tampilkan Semuanya</a></li>
					@foreach($genres->sortBy('name') as $genre)
						<li class="nav-genre__item"><a class="nav-genre__link" href="{{ route('frontBrowseGenre', $genre->slug) }}" alt="Tampilkan anime dengan genre {{ $genre->name }}">{{$genre->name}}</a></li>
					@endforeach
				</ul>
			</li>
			<li class="dropdown navkanan__item">
				<a href="#" class="dropdown-toggle navkanan__link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-search"></i></a>
				<ul class="dropdown-menu nav-menu">
					<li class="yamm-content nav-menu__item nav-menu__item--search">
						<form action="{{ route('frontBrowse') }}">
							<div class="input-group">
						    	<input type="text" class="form-control" id="search-query" name="s" placeholder="Masukkan keyword atau judul anime disini" value="{{ isset($s) ? $s : '' }}">
							<span class="input-group-btn">
								<button type="submit" class="btn btn-primary">Search</button>
							</span>
						  	</div>
						</form>
					</li>
				</ul>
			</li>
			<li class="dropdown navkanan__item">
		      <a href="#" class="dropdown-toggle navkanan__link navkanan__link--ongoing" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-fire"></i> ON-GOING</a>
				<ul class="dropdown-menu nav-menu">
					<li class="nav-menu__item">
						<div class="yamm-content">
							<ul class="media-list navbar-media">
								@foreach($navOngoing as $ongoing)
                    <li class="media navbar-media__item">
                    	<a href="{{ route('frontPlayEps', [$ongoing->series->slug, $ongoing->slug]) }}" class="navbar-media__link">
                        	<div class="media-body navbar-media__body">
                          	<h4 class="media-heading navbar-media__heading">Episode {{ $ongoing->episode }} : {{ $ongoing->judul_episode }}</h4>
                          	{{ $ongoing->series->title }}
                        	</div>
                      	<div class="media-right media-middle navbar-media__right">
                      		<img src="{{ asset('images/ongoing/'.$ongoing->cover) }}" alt="{{ $ongoing->judul_episode }}" class="media-object navbar-media__image">
                      	</div>
                      </a>
                    </li>
								@endforeach
              </ul>
						</div>
						<!-- /.yamm-content -->
					</li>
				</ul>
			</li>
		</ul>
	</div>{{-- /.navbar-collapse --}}
</div>{{-- /.container --}}
