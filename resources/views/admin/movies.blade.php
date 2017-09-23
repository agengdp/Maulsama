@extends('layouts.app')
@section('title', 'Movies')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
              Movies
              <a class="btn btn-primary btn-xs pull-right" href="{{ route('movies.create') }}">New Movie</a>
            </div>

            <div class="panel-body">

              <table class="table table-hover">
                <caption>This is all the movies list</caption>
                <div class="input-group">
                  {{ Form::open(array('route' => 'movies.index', 'method' => 'get')) }}
                    {{ Form::text('s', '', array('class' => 'form-control', 'placeholder' => 'Masukkan judul film / creatornya ...')) }}
                    <span class="input-group-btn">
                      {{ Form::submit('Cari', array('class' => 'btn btn-default')) }}
                    </span>
                  {{ Form::close() }}
                </div><!-- /input-group -->
                <thead>
                  <tr>
                    <th>#</th>
                    <th width="70%">Title</th>
                    <th>Published</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($movies as $movie)
                      <tr>
                        <th scope="row"><input type="checkbox" name="" value="1"></th>
                        <td width="70%"><a href="{{route('movies.edit', $movie->id)}}">{{$movie->title}}</a></td>
                        <td>{{$movie->created_at}} </td>
                        <td>
                          <a class="btn btn-default btn-xs" href="{{ route('movies.edit', $movie->id)}}">Edit</a>
                          <a class="btn btn-danger btn-xs" href="{{route('movies.destroy', $movie->id)}}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Yakin ingin menghapus movie ini ?">Delete</a>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
               </table>

               <div class="row">
                 <div class="col-md-6">
                   <div class="dropup">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Bulk Action
                      <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                      <li><a href="#">Action</a></li>
                      <li><a href="#">Another action</a></li>
                      <li><a href="#">Something else here</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="#">Separated link</a></li>
                    </ul>
                  </div>
                 </div>
                 <div class="col-md-6">
                  <div class="pull-right">
                     @if(isset($s))
                      {{ $movies->appends(['s' => $s])->links() }}
                     @else
                      {{ $movies->links() }}
                     @endif
                  </div>
                 </div>
               </div>

            </div>
        </div>
    </div>
</div>

@endsection


@section('lastfooter')







@endsection
