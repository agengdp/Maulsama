<div class="container">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	    <span class="sr-only">Toggle navigation</span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="/">Animestream</a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<li class="dropdown">
		      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-th-list"></i> Series <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li>
						<div class="yamm-content nav-krieg">
							<ul class="media-list">
								@foreach($navSeries as $navSeri)
			                        <li class="media">
			                        	<a href="{{ route('frontSeries', $navSeri->slug) }}" alt="{{ $navSeri->title }}">
				                        	<div class="media-body">
				                            	<h4 class="media-heading">{{ $navSeri->title }}</h4>
				                            	{{ str_limit($navSeri->sinopsis, 300) }}
				                        	</div>
				                        	<div class="media-right">
				                        		<img src="{{ asset('images/nav/'.$navSeri->cover) }}" alt="{{ $navSeri->title }}" class="media-object">
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
			<li class="dropdown">
		      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-film"></i> Movies <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li>
						<div class="yamm-content nav-krieg">
							<ul class="media-list">
								@foreach($navMovies as $navMovie)
			                        <li class="media">
			                        	<a href="{{ route('frontMovie', $navMovie->slug) }}">
				                          	<div class="media-body">
				                            	<h4 class="media-heading">{{ $navMovie->title }}</h4>
				                            	{{ str_limit($navMovie->sinopsis, 200) }}
				                          	</div>
				                        	<div class="media-right">
				                        		<img src="{{ asset('images/nav/'.$navMovie->cover) }}" alt="{{ $navMovie->title }}" class="media-object">
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
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown menu-genre">
		  		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" alt="Tampilkan Genre !"><i class="glyphicon glyphicon-th"></i></a>
				<ul class="dropdown-menu">
						<li><a href="/browse" alt="Tampilkan semuanya">Tampilkan Semuanya</a></li>
					@foreach($genres->sortBy('name') as $genre)
						<li><a href="{{ route('frontBrowseGenre', $genre->slug) }}" alt="Tampilkan anime dengan genre {{ $genre->name }}">{{$genre->name}}</a></li>
					@endforeach
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-search"></i></a>
				<ul class="dropdown-menu">
					<li class="yamm-content">
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
			<li class="dropdown">
		      <a href="#" class="dropdown-toggle hoxx" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-fire"></i> ON-GOING</a>
				<ul class="dropdown-menu">
					<li>
						<div class="yamm-content nav-krieg">
							<ul class="media-list">
								@foreach($navOngoing as $ongoing)
			                        <li class="media">
			                        	<a href="{{ route('frontPlayEps', [$ongoing->series->slug, $ongoing->slug]) }}">
				                          	<div class="media-body">
				                            	<h4 class="media-heading">Episode {{ $ongoing->episode }} : {{ $ongoing->judul_episode }}</h4>
				                            	{{ $ongoing->series->title }}
				                          	</div>
				                        	<div class="media-right media-middle">
				                        		<img src="{{ asset('images/ongoing/'.$ongoing->cover) }}" alt="{{ $ongoing->judul_episode }}" class="media-object">
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
