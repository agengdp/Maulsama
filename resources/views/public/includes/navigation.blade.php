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
						<div class="yamm-content">
							<ul class="media-list">
		                        <li class="media"><a href="#" class="pull-right"><img src="//via.placeholder.com/64x64" alt="64x64" class="media-object"></a>
		                          <div class="media-body">
		                            <h4 class="media-heading">Media heading</h4>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante.
		                          </div>
		                        </li>
		                        <li class="media"><a href="#" class="pull-right"><img src="//via.placeholder.com/64x64" alt="64x64" class="media-object"></a>
		                          <div class="media-body">
		                            <h4 class="media-heading">Media heading</h4>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.
		                          </div>
		                        </li>
		                        <li class="media"><a href="#" class="pull-right"><img src="//via.placeholder.com/64x64" alt="64x64" class="media-object"></a>
		                          <div class="media-body">
		                            <h4 class="media-heading">Media heading</h4>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.
		                          </div>
		                        </li>
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
						<div class="yamm-content">
							<ul class="media-list">
		                        <li class="media"><a href="#" class="pull-right"><img src="//via.placeholder.com/64x64" alt="64x64" class="media-object"></a>
		                          <div class="media-body">
		                            <h4 class="media-heading">Media heading</h4>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante.
		                          </div>
		                        </li>
		                        <li class="media"><a href="#" class="pull-right"><img src="//via.placeholder.com/64x64" alt="64x64" class="media-object"></a>
		                          <div class="media-body">
		                            <h4 class="media-heading">Media heading</h4>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.
		                          </div>
		                        </li>
		                        <li class="media"><a href="#" class="pull-right"><img src="//via.placeholder.com/64x64" alt="64x64" class="media-object"></a>
		                          <div class="media-body">
		                            <h4 class="media-heading">Media heading</h4>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.
		                          </div>
		                        </li>
		                      </ul>
						</div>
						<!-- /.yamm-content -->
					</li>
				</ul>
			</li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
		      <a href="#" class="dropdown-toggle hoxx" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-fire"></i> ON-GOING</a>
				<ul class="dropdown-menu">
					<li>
						<div class="yamm-content">
							<ul class="media-list">
		                        <li class="media"><a href="#" class="pull-right"><img src="//via.placeholder.com/64x64" alt="64x64" class="media-object"></a>
		                          <div class="media-body">
		                            <h4 class="media-heading">Media heading</h4>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante.
		                          </div>
		                        </li>
		                        <li class="media"><a href="#" class="pull-right"><img src="//via.placeholder.com/64x64" alt="64x64" class="media-object"></a>
		                          <div class="media-body">
		                            <h4 class="media-heading">Media heading</h4>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.
		                          </div>
		                        </li>
		                        <li class="media"><a href="#" class="pull-right"><img src="//via.placeholder.com/64x64" alt="64x64" class="media-object"></a>
		                          <div class="media-body">
		                            <h4 class="media-heading">Media heading</h4>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.
		                          </div>
		                        </li>
		                      </ul>
						</div>
						<!-- /.yamm-content -->
					</li>
				</ul>
			</li>
			<li class="dropdown menu-genre">
		  		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-th"></i> Genre</a>
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

						<input type="text" value="" name="q" placeholder="Masukkan judul film disini..."><input type="submit" class="btn btn-default" value="Search">

					</li>
				</ul>
			</li>
		</ul>
	</div>{{-- /.navbar-collapse --}}
</div>{{-- /.container --}}
