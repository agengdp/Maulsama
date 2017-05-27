@extends('layouts.app')
@section('title', 'Series')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
              Series
              <a class="btn btn-primary btn-xs pull-right" href="{{ route('series.create') }}">New Series</a>
            </div>

            <div class="panel-body">

              <table class="table table-hover">
                <caption>This is all the series lists</caption>
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Cari</button>
                  </span>
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
                    @foreach ($series as $seri)
                      <tr>
                        <th scope="row"><input type="checkbox" name="" value="1"></th>
                        <td width="70%"><a href="{{route('series.show', $seri->id)}}">{{$seri->title}}</a></td>
                        <td>{{$seri->created_at}} </td>
                        <td>
                          <a class="btn btn-default btn-xs" href="{{ route('series.edit', $seri->id)}}">Edit</a>
                          
                          <a class="btn btn-primary btn-xs" href="{{ route('series.show', $seri->id)}}">View</a>
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
