@extends('layouts.app')
@section('title', 'Genre')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
              All Genre
              <a class="btn btn-primary btn-xs pull-right" href="#" data-toggle="modal" data-target="#new-genre">New Genre</a>
            </div>

            <div class="panel-body">
              <table class="table table-hover">
                <caption>This is all the genre lists</caption>
                <thead>
                  <tr>
                    <th>#</th>
                    <th width="70%">Nama Genre</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($genres as $genre_loop)
                      <tr>
                        <th scope="row"><input type="checkbox" name="" value="1"></th>
                        <td width="80%"><a href="{{route('genre.show', $genre_loop->id)}}">{{$genre_loop->name}}</a></td>
                        <td>
                          <a class="btn btn-default btn-xs" href="{{ route('genre.edit', $genre_loop->id)}}">Edit</a>
                          <a class="btn btn-primary btn-xs" href="{{ route('genre.show', $genre_loop->id)}}">View</a>
                          <a class="btn btn-danger btn-xs" href="{{ route('genre.destroy', $genre_loop->id)}}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Yakin ingin menghapus genre ini ?">Delete</a>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
               </table>

               <div class="row">
                 <div class="col-md-12">
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
               </div>

            </div>
        </div>
    </div>
</div>


<!-- modal untuk new genre -->
<div class="modal fade" id="new-genre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      {{ Form::open(array('route' => 'genre.store')) }}    
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel">Masukkan nama genre baru..</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="episode" class="control-label">Genre</label>
              <input type="text" class="form-control" id="genre" name="name">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <input type="submit" class="btn btn-primary" value="Tambah Genre Baru">
        </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
<!-- end of modal untuk new genre -->
@endsection
