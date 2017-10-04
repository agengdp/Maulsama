@extends('layouts.app')
@section('title')
 Edit: {{$series->title}}
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                  Edit Series
                  <a class="btn btn-primary btn-xs pull-right" href="{{ route('series.show', $series->id) }}"><- Back</a>
                </div>

                <div class="panel-body">
                  <form enctype="multipart/form-data" action="{{ route('series.update', $series->id) }}" method="post">
                      <div class="row">
                        <div class="col-md-3">
                          <div class="cover">
                            <img id="uploadedimage" src="{{asset("storage/$series->cover")}}" class="cover" />
                          </div>

                                 <input type="hidden" name="MAX_UPLOAD_SIZE" value="250000">
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
                                <input type="text" class="form-control" name="title" placeholder="Judul Anime" value="{{$series->title}}">
                                {{ ($errors->has('title')) ? $errors->first('title') : '' }}
                              </div>
                            </div>
                          </div>

                          <br/>

                          <div class="row">
                            <div class="col-md-2">
                              Tahun rilis
                              <input class="form-control" type="text" name="year" placeholder="1993" value="{{$series->year}}">
                              {{ ($errors->has('year')) ? $errors->first('year') : '' }}
                            </div>
                            <div class="col-md-5">
                              Creator
                              <input class="form-control" type="text" name="creator" placeholder="Creator" value="{{$series->creator}}">
                              {{ ($errors->has('creator')) ? $errors->first('creator') : '' }}
                            </div>
                            <div class="col-md-5">
                              Producer
                              <input class="form-control" type="text" name="producer" placeholder="Producer" value="{{$series->producer}}">
                              {{ ($errors->has('producer')) ? $errors->first('producer') : '' }}
                            </div>
                          </div>

                          <br/>

                          <div class="row">
                            <div class="col-md-12">
                              Genre
                              <select id="genre" class="form-control" name="genre[]" multiple="multiple">
                                @foreach ($genres as $value)
                                  <option value="{{ $value['name'] }}" @if($value['selected']) selected @endif>{{ $value['name'] }}</option>
                                @endforeach
                              </select>
                              {{ ($errors->has('genre')) ? $errors->first('genre') : '' }}
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-12">
                              Sinopsis
                              <textarea name="sinopsis" class="form-control" rows="8" cols="80" placeholder="Masukkan sinopsis dari series disini">{{$series->sinopsis}}</textarea>
                              {{ ($errors->has('sinopsis')) ? $errors->first('sinopsis') : '' }}
                            </div>
                          </div>

                          <br/>

                          <input type="hidden" name="_token" value="{{csrf_token()}}">
                          <input type="hidden" name="_method" value="PUT">
                          <input class="btn btn-primary pull-right" type="submit" name="publish" value="Update">
                        </div>
                      </div>
                    </form>
                  </div>
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

  // Predefined selected genre
  // $('#genre').select2().val([@foreach ($series->genre as $value){{ $loop->first ? '' : ', ' }} '{{ $value->name }}' @endforeach]);
});

</script>
@endsection
