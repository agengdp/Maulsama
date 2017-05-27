@extends('layouts.app')
@section('title')
 Series: {{$series->title}}
@endsection

@section('content')
<div class="row">

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
              {{$series->title}}
              <ul class="menu-header-panel pull-right">
                <li>
                  <a class="btn btn-primary btn-xs" href="{{ route('series.index') }}"> <- Back </a>
                </li>
                <li>
                  <a class="btn btn-default btn-xs" href="{{ route('series.edit', $series->id) }}"> Edit </a>
                </li>
                <li>
                  <a class="btn btn-danger btn-xs" href="{{route('series.destroy', $series->id)}}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Yakin ingin menghapus seri ini ?"> Delete </a>
                </li>
              </ul>
            </div>

            <div class="panel-body">
              
              <div class="row">
                <div class="col-md-3">
                  <div class="cover">
                    <img class="cover" src="{{asset("storage/$series->cover")}}" alt="">
                  </div>
                </div>
                <div class="col-md-9">
                  <h1 class="adm-panel-title">{{ $series->title }}</h1>
                  ID : {{ $series->id }} | Genre : @foreach ($series->genre as $genre) <span class="label label-default"> {{$genre->name}} </span>  @endforeach | Year : {{$series->year}}
                  <br/>
                   Creator : {{$series->creator}} | Producer : {{$series->producer}}

                  <hr/>


                  <p>
                    {{ $series->sinopsis }}
                  </p>

                  <hr/>
                  {{ $series->genres }}
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <h2>List of {{$series->title}} episodes</h2>
                  <table class="table table-hover table-striped">
                    <thead>
                      <tr>
                        <th>Eps</th>
                        <th width="70%">Title</th>
                        <th>Published</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($episodes as $episode)
                          <tr>
                            <th scope="row">{{$episode->episode}}</th>
                            <td width="70%">{{$episode->judul_episode}}</td>
                            <td>{{$episode->created_at}}</td>
                            <td>
                              <ul class="action-menu">
                                <li>
                                  <a class="btn btn-primary btn-xs btn-edit-episode" href="#edit-episode" data-toggle="modal" data-target="#edit-episode" data-episode="{{ $episode }}" data-action-link="{{ route('episode.update', [$series->id, $episode->id])}}" data-image-url="<?= asset("storage/$episode->cover"); ?>">Edit</a>
                                </li>
                                <li>
                                  <a class="btn btn-danger btn-xs" onclick="perform_delete('{{ route('episode.destroy', [$series->id, $episode->id]) }}');" href="{{ route('episode.destroy', [$series->id, $episode->id]) }}" data-toggle="modal" data-target="#delete-episode" data-episode="{{ $episode->episode }}" data-judul="{{ $episode->judul_episode }}">Delete</a>
                                </li>
                              </ul>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                   </table>
                </div>

                <div class="col-md-6">
                  <button class="btn btn-primary" type="button" name="addEps" data-toggle="modal" data-target="#add-episode" data-backdrop="static">Tambah Episode</button>
                </div>
                <div class="col-md-6">
                  <div class="pull-right">
                    {{ $episodes->links() }}
                  </div>
                </div>
              </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal untuk edit episode -->
<div id="edit-episode" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form enctype="multipart/form-data" id="form-edit-episode" action="{{ route('episode.update', [$series->id, $series->id])}}" method="post">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Edit Episode</h4>
        </div>
        <div class="modal-body">

            <div class="row">
              <div class="col-md-12">
                <center>
                  <div class="episode-cover">
                    <div class="clearfix">
                      <input type="hidden" name="MAX_UPLOAD_SIZE" value="250000">
                      <input class="inputfile" type="file" name="edit-episode-cover" id="jimage" accept="image/*">
                      <label for="jimage">Upload Cover</label>
                      <p>
                          <span id="imageerror" style="font-weight: bold; color: red"></span>
                      </p>
                    </div>
                    <img id="uploadedimage" src="" class="episode-cover" />
                  </div>
                </center>
                <hr />

              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="episode">Episode</label>
                  <input type="text" class="form-control" id="episode" placeholder="Episode" name="episode">
                </div>
              </div>
              <div class="col-md-10">
                <div class="form-group">
                  <label for="judul">Judul</label>
                  <input type="text" class="form-control" id="judul" placeholder="Judul episode" name="judul_episode">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="spoiler">Spoiler</label>
                  <textarea id="spoiler" rows="3" class="form-control" placeholder="Spoiler" name="spoiler"></textarea>
                </div>
              </div>

              <!-- outer repeater -->
              <div class="col-md-12">
                <label>Video Lists</label>
              </div>

                <div class="repeater-edit">
                    <div data-repeater-list="episode_list">
                        <div data-repeater-item>
                            <div class="col-md-2" style="margin-bottom:5px">
                                <select class="form-control" name="video_type">
                                  <option value="mp4">Mp4</option>
                                  <option value="mkv">MKV</option>
                                  <option value="flv">FLV</option>
                                  <option value="3gp">3gp</option>
                                </select>
                            </div>
                            <div class="col-md-2" style="margin-bottom:5px">
                                <select class="form-control" name="video_quality">
                                  <option value="1080p">1080p</option>
                                  <option value="720p">720p</option>
                                  <option value="480p">480p</option>
                                  <option value="360p">360p</option>
                                  <option value="144p">144</option>
                                </select>
                            </div>
                            <div class="col-md-8" style="margin-bottom:5px">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="video_url" value="" placeholder="URL video disini">
                                    <span class="input-group-btn">
                                      <button type="button" name="button" class="btn btn-danger" data-repeater-delete> - </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" style="padding-top:3px">
                        <input data-repeater-create type="button" class="btn btn-primary pull-right" value="Add" />
                    </div>
                </div>

            </div>

        </div>
        <div class="modal-footer">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="_method" value="PUT">
          <input type="hidden" id="episode_id" name="episode_id" value="">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" name="tambah_video" value="Update Episode" class="btn btn-primary">
        </div>
      </div>
    </form>
  </div>
</div>
<!-- End of modal untuk edit episode -->


<!-- Modal untuk tambah episode -->
<div id="add-episode" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form enctype="multipart/form-data" class="" action="{{ route('episode.store', $series->id)}}" method="post">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Tambah Episode</h4>
        </div>
        <div class="modal-body">

            <div class="row">
              <div class="col-md-12">
                <center>
                  <div class="episode-cover">
                    <div class="clearfix">
                      <input type="hidden" name="MAX_UPLOAD_SIZE" value="250000">
                      <input class="inputfile" type="file" name="cover-episode" id="coverEpisode" accept="image/*">
                      <label for="coverEpisode">Upload Cover</label>
                      <p>
                          <span id="imageerror" style="font-weight: bold; color: red"></span>
                      </p>
                    </div>
                    <img id="uploadedimage1" src="" class="episode-cover" />
                  </div>
                </center>
                <hr/>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="episode">Episode</label>
                  <input type="text" class="form-control" id="episode" placeholder="Episode" name="episode">
                </div>
              </div>
              <div class="col-md-10">
                <div class="form-group">
                  <label for="judul">Judul</label>
                  <input type="text" class="form-control" id="judul" placeholder="Judul episode" name="judul_episode">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="spoiler">Spoiler</label>
                  <textarea id="spoiler" rows="3" class="form-control" placeholder="Spoiler" name="spoiler"></textarea>
                </div>
              </div>

              <!-- outer repeater -->
              <div class="col-md-12">
                <label>Video Lists</label>
              </div>

                <div class="repeater">
                    <div data-repeater-list="episode_list">
                        <div data-repeater-item>
                            <div class="col-md-2" style="margin-bottom:5px">
                                <select class="form-control" name="video_type">
                                  <option value="mp4">Mp4</option>
                                  <option value="mkv">MKV</option>
                                  <option value="flv">FLV</option>
                                  <option value="3gp">3gp</option>
                                </select>
                            </div>
                            <div class="col-md-2" style="margin-bottom:5px">
                                <select class="form-control" name="video_quality">
                                  <option value="1080p">1080p</option>
                                  <option value="720p">720p</option>
                                  <option value="480p">480p</option>
                                  <option value="360p">360p</option>
                                  <option value="144p">144</option>
                                </select>
                            </div>
                            <div class="col-md-8" style="margin-bottom:5px">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="video_url" value="" placeholder="URL video disini">
                                    <span class="input-group-btn">
                                      <button type="button" name="button" class="btn btn-danger" data-repeater-delete> - </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" style="padding-top:3px">
                        <input data-repeater-create type="button" class="btn btn-primary pull-right" value="Add" />
                    </div>
                </div>

            </div>

        </div>
        <div class="modal-footer">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" name="tambah_video" value="Tambahkan" class="btn btn-primary">
        </div>
      </div>
    </form>
  </div>
</div>
<!-- end of modal untuk tambah episode -->

<!-- modal untuk delete episode -->
<div class="modal fade" id="delete-episode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Yakin ingin menghapus episode ini ?</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="episode" class="control-label">Episode:</label>
            <input type="text" class="form-control" id="episode" name="episode" disabled>
          </div>
          <div class="form-group">
            <label for="judul" class="control-label">Judul:</label>
            <input type="text" class="form-control" id="judul" name="judul" disabled>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <a id="hapus-series" class="btn btn-danger" data-method="delete" data-token="{{csrf_token()}}">Hapus</a>
      </div>
    </div>
  </div>
</div>
<!-- end of modal untuk delete episode -->

@endsection

@section('lastfooter')
<script type="text/javascript">
function perform_delete($links){
  document.getElementById('hapus-series').href = $links;
}
</script>
@endsection
