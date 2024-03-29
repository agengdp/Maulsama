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
                  {{ Form::open(array('route'=> 'series.index', 'method' => 'get')) }}
                    {{ Form::text('s', '', array('class' => 'form-control', 'placeholder' => 'Masukkan nama judul / creator disini...')) }}
                    <span class="input-group-btn">
                      {{ Form::submit('Cari', array('class' => 'btn btn-default')) }}
                    </span>
                  {{ Form::close() }}
                  </div><!-- /input-group -->
                <thead>
                  <tr>
                    <th>#</th>
                    <th width="60%">Title</th>
                    <th>Episode</th>
                    <th>Status</th>
                    <th>Published</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($series as $seri)
                      <tr>
                        <th scope="row"><input type="checkbox" name="" value="1"></th>
                        <td width="60%"><a href="{{route('series.show', $seri->id)}}">{{$seri->title}}</a></td>
                        <td>{{count($seri->episode)}} </td>
                        <td>
                          @if($seri->status == 'ongoing')
                            <span class="label label-warning">{{$seri->status}}</span>
                          @else
                            {{$seri->status}}
                          @endif
                        </td>
                        <td>{{$seri->created_at}} </td>
                        <td>
                          <a class="btn btn-default btn-xs" href="{{ route('series.edit', $seri->id)}}">Edit</a>

                          <a class="btn btn-primary btn-xs" href="{{ route('series.show', $seri->id)}}">View</a>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td class="text-center" colspan="4">
                          Tidak ada series sama sekali...
                        </td>
                      </tr>

                    @endforelse
                </tbody>
               </table>


               <div class="row">
                 <div class="col-md-6">
                   <div class="dropup">
                    {{-- <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Bulk Action
                      <span class="caret"></span>
                    </button> --}}
                    {{-- <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                      <li><a href="#">Action</a></li>
                      <li><a href="#">Another action</a></li>
                      <li><a href="#">Something else here</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="#">Separated link</a></li>
                    </ul> --}}
                  </div>
                 </div>
                 <div class="col-md-6">
                  <div class="pull-right">
                  @if(isset($s))
                    {{ $series->appends(['s' => $s])->links() }}
                  @else
                    {{ $series->links() }}
                  @endif
                  </div>
                 </div>
               </div>

            </div>
        </div>
    </div>
</div>
@endsection
