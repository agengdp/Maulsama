@extends('layouts.app')
@section('title', 'Create New Movie')
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        Post New Movie
        <a class="btn btn-primary btn-xs pull-right" href="{{ route('movies.index') }}"><- Back</a>
      </div> {{-- end of panel heading --}}

      <div class="panel-body">
        <form enctype="multipart/form-data" method="post" action="{{route('movies.store')}}">
          <div class="row">
            <div class="col-md-3">
              <div class="cover">
                <img id="uploadedimage" class="cover" />
              </div> {{-- end of cover --}}
              <input type="hidden" name="MAX_UPLOAD_SIZE" value="250000">
              <input type="file" class="inputfile" name="cover" id="jimage" accept="image/*" required>
              <label for="jimage">Upload cover</label>
              <p>
                <span id="imageerror" style="font-weight: bold;color: red"></span>
              </p>
            </div> {{-- end of col-md-3 --}}

            <div class="col-md-9">
              <div class="row">
                <div class="col-md-12">
                  <input type="text" name="title" class="form-control" placeholder="Judul Movie">
                  {{ ($errors->has('title')) ? $errors->first('title') : '' }}
                </div> {{-- end of col-md-12 --}}
              </div> {{-- end of row --}}

              <div class="row">
                <div class="col-md-2">
                  Tahun rilis
                  <input type="text" name="year" class="form-control" placeholder="2016">
                  {{ ($errors->has('year')) ? $errors->first('year') : '' }}
                </div> {{-- end of col-md-2 --}}

                <div class="col-md-5">
                  Creator
                  <input type="text" name="creator" class="form-control" placeholder="Creator">
                  {{ ($errors->has('creator')) ? $errors->first('creator') : '' }}
                </div> {{-- end of col-md-5 --}}

                <div class="col-md-5">
                  Producer
                  <input type="text" name="producer" class="form-control" placeholder="Producer">
                  {{ ($errors->has('producer')) ? $errors->first('producer') : '' }}
                </div> {{-- end of col-md-5 --}}
              </div> {{-- end of row --}}

              <div class="row">
                <div class="col-md-12">
                  Genre
                  <input id="genre" name="genre"></input>
                  {{ ($errors->has('genre')) ? $errors->first('genre') : '' }}
                </div> {{-- end of col-md-12 --}}
              </div> {{-- end of row --}}

              <div class="row">
                <div class="col-md-12">
                  Sinopsis
                  <textarea name="sinopsis" class="form-control" rows="8" cols="80" placeholder="Masukkan sinopsis dari movies disini"></textarea>
                  {{ ($errors->has('sinopsis')) ? $errors->first('sinopsis') : '' }}
                </div> {{-- end of col-md-12 --}}
              </div> {{-- end of row --}}

            </div> {{-- end of col-md-9 --}}

          </div> {{-- end of row --}}

          <div class="row underliner">
            <div class="col-md-9">
              <h4>Video list</h4>
              <div class="repeater">
                <div data-repeater-list="movie_video_list">
                  <div data-repeater-item>
                    <div class="row">
                      <div class="col-md-2" style="margin-bottom:5px">
                        <select class="form-control" name="video_type">
                          <option value="mp4">Mp4</option>
                          <option value="mkv">MKV</option>
                          <option value="flv">FLV</option>
                          <option value="3gp">3gp</option>
                        </select>
                      </div> {{-- end of col-md-2 --}}
                      <div class="col-md-2" style="margin-bottom:5px">
                        <select class="form-control" name="video_quality">
                          <option value="1080p">1080p</option>
                          <option value="720p">720p</option>
                          <option value="480p">480p</option>
                          <option value="360p">360p</option>
                          <option value="144p">144</option>
                        </select>
                      </div> {{-- end of col-md-2 --}}
                      <div class="col-md-8" style="margin-bottom:5px">
                        <div class="input-group">
                            <input class="form-control" type="text" name="video_url" value="" placeholder="URL video disini">
                            <span class="input-group-btn">
                              <button type="button" name="button" class="btn btn-danger" data-repeater-delete> - </button>
                            </span>
                        </div>
                      </div> {{-- end of col-md-8 --}}
                    </div> {{-- end of row --}}
                  </div> {{-- end of data-repeater-item --}}
                </div> {{-- end of data-repeater-list --}}
                <div class="row">
                  <div class="col-md-12">
                    <input data-repeater-create type="button" class="btn btn-primary pull-right" value="add" />
                  </div> {{-- end of col-md-12 --}}
                </div> {{-- end of row --}}
              </div> {{-- end of repeater --}}
            </div> {{-- end of col-md-9 --}}
            <div class="col-md-3">
              <div class="panel panel-default panel-action">
                {{ csrf_field() }}
                <input type="submit" name="submit" class="btn btn-primary btn-block" value="Publish">
              </div>
            </div> {{-- end of col-md-2 --}}
          </div> {{-- end of row --}}

        </form>
      </div> {{-- end of panel-body --}}

    </div> {{-- end of panel --}}
  </div> {{-- end of col-md-12 --}}
</div> {{-- end of row --}}
@endsection

@section('lastfooter')
<script type="text/javascript">
$(function() {
  $('#genre').selectize({
    maxItems: null,
    valueField: 'id',
    labelField: 'name',
    options: {!! $genre_data !!},
    create: false

  });
});
</script>
@endsection
