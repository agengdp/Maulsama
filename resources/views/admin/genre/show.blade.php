@extends('layouts.app')
@section('title')
 Series: {{$genre->name}}
@endsection

@section('content')
<div class="row">

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
              {{$genre->name}}
              <ul class="menu-header-panel pull-right">
                <li>
                  <a class="btn btn-primary btn-xs" href="{{ route('genre.index') }}"> <- Back </a>
                </li>
                <li>
                  <a class="btn btn-default btn-xs" href="{{ route('genre.edit', $genre->id) }}"> Edit </a>
                </li>
                <li>
                  <a class="btn btn-danger btn-xs" href="{{route('genre.destroy', $genre->id)}}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Yakin ingin menghapus seri ini ?"> Delete </a>
                </li>
              </ul>
            </div>

            <div class="panel-body">
              <h3>Series</h3>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>
                      #
                    </th>
                    <th>Series</th>
                    <th>Genres</th>
                  </tr> 
                </thead>
                <tbody>
                  @foreach($genre->series as $series)
                    <tr>
                      <th scrope="row">#</th>
                      <td>
                        <a href="{{ route('series.show', $series->id)}}">{{$series->title}}</a>
                      </td>
                      <td>
                        @foreach($series->genre as $gens)
                          <span class="label label-default">{{$gens->name}}</span>
                        @endforeach
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

              <h3>Movies</h3>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>
                      #
                    </th>
                    <th>Movie</th>
                    <th>Genres</th>
                  </tr> 
                </thead>
                <tbody>
                  @foreach($genre->movies as $movie)
                    <tr>
                      <th scrope="row">#</th>
                      <td>
                        <a href="{{ route('movies.edit', $movie->id)}}">{{$movie->title}}</a>
                      </td>
                      <td>
                        @foreach($movie->genre as $gens)
                          <span class="label label-default">{{$gens->name}}</span>
                        @endforeach
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>              
            </div>
        </div>
    </div>
</div>

@endsection

@section('lastfooter')
<script type="text/javascript">
function perform_delete($links){
  document.getElementById('hapus-series').href = $links;
}
</script>
@endsection
