@extends('layouts.app')
@section('title', 'Create New Series')

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
                  Post New Series
                  <a class="btn btn-primary btn-xs pull-right" href="{{ route('series.index') }}"><- Back</a>
                </div>

                <div class="panel-body">
                  {{ Form::open(array('files' => 'true', 'method' => 'POST', 'route' => 'series.store')) }}
                      <div class="row">
                        <div class="col-md-3">
                          <div class="cover">
                            <img id="uploadedimage" class="cover" />
                          </div>

                           <input type="hidden" name="MAX_UPLOAD_SIZE" value="2500000">
                           <input class="inputfile" type="file" name="cover" id="jimage" accept="image/*">
                           <label for="jimage">Choose a file</label>
                           <p>
                               <span id="imageerror" style="font-weight: bold; color: red"></span>
                           </p>
                        </div>
                        <div class="col-md-9">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group form-group-lg">
                                {{ Form::text('title', null, array('class' => 'form-control', 'placeholder' => 'Judul Anime', 'required' => '')) }}
                                {{ ($errors->has('title')) ? $errors->first('title') : '' }}
                              </div>
                            </div>
                          </div>

                          <br/>

                          <div class="row">
                            <div class="col-md-2">
                              Tahun rilis
                              {{ Form::text('year', null, array('class' => 'form-control', 'placeholder' => '2009', 'required' => '')) }}
                              {{ ($errors->has('year')) ? $errors->first('year') : '' }}
                            </div>
                            <div class="col-md-5">
                              Creator
                              {{ Form::text('creator', null, array('class' => 'form-control', 'placeholder' => 'Creator', 'required' => '')) }}
                              {{ ($errors->has('creator')) ? $errors->first('creator') : '' }}
                            </div>
                            <div class="col-md-5">
                              Producer
                              {{ Form::text('producer', null, array('class' => 'form-control', 'placeholder' => 'Producer', 'required' => '')) }}
                              {{ ($errors->has('producer')) ? $errors->first('producer') : '' }}
                            </div>
                          </div>

                          <br/>

                          <div class="row">
                            <div class="col-md-12">
                              Genre
                              {{-- Ini harus di ubah jadi Blade seharusnya --}}
                              {{-- WOOOOOOOOOOUUUUIIIIIII --}}
                              <select id="genre" class="form-control" name="genre[]" multiple="multiple" required>
                                @foreach ($genre_data as $value)
                                  <option value="{{ $value->name }}">{{ $value->name }}</option>
                                @endforeach
                              </select>
                              {{ ($errors->has('genre')) ? $errors->first('genre') : '' }}
                            </div>
                          </div>

                          <br/>

                          <div class="row">
                            <div class="col-md-12">
                              Sinopsis
                              {{ Form::textarea('sinopsis', null, array('id' => 'sinopsis', 'class' => 'form-control', 'placeholder' => 'Masukkan sinopsis dari series disini')) }}
                              {{ ($errors->has('sinopsis')) ? $errors->first('sinopsis') : '' }}
                            </div>
                          </div>

                          <hr/>

                          <div class="row">

                            <div class="col-md-10">
                              <div class="form-group">
                                  {{ Form::label('status', 'Status : ', array('class' => 'col-sm-2 control-label')) }}
                                  <div class="col-sm-10">
                                    {{ Form::select('status', ['complete' => 'Complete', 'ongoing' => 'Ongoing'], null, array('class' => 'form-control', 'required' => '')) }}
                                  </div>
                              </div>
                            </div>
                            <!-- /.col-md-10 -->
                            <div class="col-md-2">
                              {{ Form::submit('Publish', array('class' => 'btn btn-primary pull-right btn-block') ) }}
                            </div>
                            <!-- /.col-md-2 -->
                          </div>
                          <!-- /.row -->

                        </div>
                      </div>
                    </div>
                  {{ Form::close() }}

            </div>
        </div>
    </div>
@endsection

@section('lastfooter')
<script type="text/javascript">
$(document).ready(function(){
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
