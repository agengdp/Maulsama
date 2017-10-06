@extends('layouts.app')
@section('title')
 Edit: {{$movie->title}}
@endsection
@section('beforehead')
      <script src="{{ asset('storage/assets/vendor/tinymce/tinymce.min.js') }}"></script>
      <script type="text/javascript">
        tinymce.init({
          selector: 'textarea#sinopsis',
          plugins: 'code link lists table',
        });
      </script>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        Edit {{ $movie->title }}
        <ul class="menu-header-panel pull-right">
          <li>
            <a class="btn btn-primary btn-xs pull-right" href="{{ route('movies.index') }}"><- Back</a>
          </li>
          <li>
            <a class="btn btn-danger btn-xs pull-right" href="{{ route('movies.destroy', $movie->id) }}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Yakin ingin menghapus movie ini?">Delete</a>
          </li>
        </ul>

      </div> {{-- end of panel heading --}}
      <div class="panel-body">
        {{ Form::open(array('files' => 'true', 'method' => 'PUT', 'route' => ['movies.update', $movie->id])) }}
          <div class="row">
            <div class="col-md-3">
              <div class="cover">
                <img src="<?= asset("storage/$movie->cover"); ?>" id="uploadedimage" class="cover" />
              </div> {{-- end of cover --}}
              <input type="hidden" name="MAX_UPLOAD_SIZE" value="250000">
              <input type="file" class="inputfile" name="cover" id="jimage" accept="image/*">
              <label for="jimage">Upload cover</label>
              <p>
                <span id="imageerror" style="font-weight: bold;color: red"></span>
              </p>
            </div> {{-- end of col-md-3 --}}

            <div class="col-md-9">
              <div class="row">
                <div class="col-md-12">
                  {{ Form::text('title', $movie->title, array('class' => 'form-control', 'placeholder' => 'Judul Movie', 'required' => '')) }}
                  {{ ($errors->has('title')) ? $errors->first('title') : '' }}
                </div> {{-- end of col-md-12 --}}
              </div> {{-- end of row --}}

              <div class="row">
                <div class="col-md-2">
                  Tahun rilis
                  {{ Form::text('year', $movie->year, array('class' => 'form-control', 'placeholder' => '2010', 'required' => '')) }}
                  {{ ($errors->has('year')) ? $errors->first('year') : '' }}
                </div> {{-- end of col-md-2 --}}

                <div class="col-md-5">
                  Creator
                  {{ Form::text('creator', $movie->creator, array('class' => 'form-control', 'placeholder' => 'Creator', 'required' => '')) }}
                  {{ ($errors->has('creator')) ? $errors->first('creator') : '' }}
                </div> {{-- end of col-md-5 --}}

                <div class="col-md-5">
                  Producer
                  {{ Form::text('producer', $movie->producer, array('class' => 'form-control', 'placeholder' => 'Producer', 'required' => '')) }}
                  {{ ($errors->has('producer')) ? $errors->first('producer') : '' }}
                </div> {{-- end of col-md-5 --}}
              </div> {{-- end of row --}}

              <div class="row">
                <div class="col-md-12">
                  Genre
                  <select id="genre" class="form-control" name="genre[]" multiple="multiple" required>
                    @foreach ($genres as $value)
                      <option value="{{ $value['name'] }}" @if($value['selected']) selected @endif>{{ $value['name'] }}</option>
                    @endforeach
                  </select>
                  {{ ($errors->has('genre')) ? $errors->first('genre') : '' }}
                </div> {{-- end of col-md-12 --}}
              </div> {{-- end of row --}}

              <div class="row">
                <div class="col-md-12">
                  Sinopsis
                  {{ Form::textarea('sinopsis', $movie->sinopsis, array('id' => 'sinopsis', 'class' => 'from-control', 'placeholder' => 'Masukkan sinopsis dari movie disini')) }}
                  {{ ($errors->has('sinopsis')) ? $errors->first('sinopsis') : '' }}
                </div> {{-- end of col-md-12 --}}
              </div> {{-- end of row --}}

            </div> {{-- end of col-md-9 --}}

          </div> {{-- end of row --}}

          <div class="row underliner">
            <div class="col-md-9">
              <h4>Video list</h4>
              <div class="repeaterMovie">
                <div data-repeater-list="movie_video_list">
                  <div data-repeater-item>
                    <div class="row">
                      <div class="col-md-2" style="margin-bottom:5px">
                        <select class="form-control" name="video_type">
                          <option value="mp4">Mp4</option>
                          <option value="mkv">MKV</option>
                        </select>
                      </div> {{-- end of col-md-2 --}}
                      <div class="col-md-2" style="margin-bottom:5px">
                        <select class="form-control" name="video_quality">
                          <option value="1080p">1080p</option>
                          <option value="720p">720p</option>
                          <option value="480p">480p</option>
                          <option value="360p">360p</option>
                          <option value="144p">144p</option>
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
                {{ Form::submit('Update', array('class' => 'btn btn-primary btn-block')) }}
              </div>
            </div> {{-- end of col-md-2 --}}
          </div> {{-- end of row --}}

        {{ Form::close() }}
      </div> {{-- end of panel-body --}}

    </div> {{-- end of panel --}}
  </div> {{-- end of col-md-12 --}}
</div> {{-- end of row --}}
@endsection

@section('lastfooter')
<script type="text/javascript">
$(document).ready(function(){
  var obj = JSON.parse('{!! $movie->download_links !!}');
  var $repeater = $('.repeaterMovie').repeater({
    initEmpty: false,

    defaultValues:{
      video_type: 'mp4',
      video_quality: '1080p',
    }
  });

  $repeater.setList(obj);
  $('#genre').select2({
    placeholder: 'Pilih Genre',
    multiple: true,
    tags: true,

    createTag: function(params){
      return {
        id: params.term,
        text: params.term,
        newOption:true,
      }
    },

    templateResult: function(data){
      var $result = $('<span></span>');
      $result.text(data.text);
      if(data.newOption){
        $result.append("<em> (new)</em>")
      }
      return $result;
    },

  });
});
</script>
@endsection
