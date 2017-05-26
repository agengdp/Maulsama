@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                  Post New Series
                  <a class="btn btn-primary btn-xs pull-right" href="{{ route('series.index') }}"><- Back</a>
                </div>

                <div class="panel-body">
                  <form enctype="multipart/form-data" action="{{ route('series.store') }}" method="post">
                      <div class="row">
                        <div class="col-md-3">
                          <div class="cover">
                            <img id="uploadedimage" class="cover" />
                          </div>

                                 <input type="hidden" name="MAX_UPLOAD_SIZE" value="250000">
                                 <input class="inputfile" type="file" name="cover" id="jimage" accept="image/*" required>
                                 <label for="jimage">Choose a file</label>
                             <p>
                                 <span id="imageerror" style="font-weight: bold; color: red"></span>
                             </p>

                        </div>
                        <div class="col-md-9">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group form-group-lg">
                                <input type="text" class="form-control" name="title" placeholder="Judul Anime">
                                {{ ($errors->has('title')) ? $errors->first('title') : '' }}
                              </div>
                            </div>
                          </div>

                          <br/>

                          <div class="row">
                            <div class="col-md-2">
                              Tahun rilis
                              <input class="form-control" type="text" name="year" placeholder="1993">
                              {{ ($errors->has('year')) ? $errors->first('year') : '' }}
                            </div>
                            <div class="col-md-5">
                              Creator
                              <input class="form-control" type="text" name="creator" placeholder="Creator">
                              {{ ($errors->has('creator')) ? $errors->first('creator') : '' }}
                            </div>
                            <div class="col-md-5">
                              Producer
                              <input class="form-control" type="text" name="producer" placeholder="Producer">
                              {{ ($errors->has('producer')) ? $errors->first('producer') : '' }}
                            </div>
                          </div>

                          <br/>

                          <div class="row">
                            <div class="col-md-12">
                              Genre
                              <input id="genre" name="genre"></input>
                              {{ ($errors->has('genre')) ? $errors->first('genre') : '' }}
                            </div>
                          </div>

                          <br/>

                          <div class="row">
                            <div class="col-md-12">
                              Sinopsis
                              <textarea name="sinopsis" class="form-control" rows="8" cols="80" placeholder="Masukkan sinopsis dari series disini"></textarea>
                              {{ ($errors->has('sinopsis')) ? $errors->first('sinopsis') : '' }}
                            </div>
                          </div>

                          <br/>

                          <input type="hidden" name="_token" value="{{csrf_token()}}">
                          <input class="btn btn-primary pull-right" type="submit" name="publish" value="Publish">


                        </div>
                      </div>
                    </div>

                  </form>
            </div>
        </div>
    </div>
@endsection

@section('lastfooter')
<script type="text/javascript">
$(function() {
  $('#genre').selectize({
    maxItems: null,
    valueField: 'id',
    labelField: 'name',
    options: {!! $genre_data !!},
    create: true

  });
});
</script>
@endsection
