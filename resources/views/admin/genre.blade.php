@extends('layouts.app')
@section('title', 'Genre')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
              All Genre
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
@endsection
