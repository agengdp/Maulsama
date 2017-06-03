@extends('layouts.app')
@section('title')
 Edit Genre : {{$genre->name}}
@endsection

@section('content')
<div class="row">

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
              Edit Genre : {{$genre->name}}
              <ul class="menu-header-panel pull-right">
                <li>
                  <a class="btn btn-primary btn-xs" href="{{ route('genre.index') }}"> <- Back </a>
                </li>
              </ul>
            </div>

            <div class="panel-body">
              <h3>Genre</h3>

              <div class="row">
                <div class="col-md-6 col-xs-12">
                  {{ Form::open(array('route' => ['genre.update', $genre->id], 'method' => 'put' )) }}

                    <div class="input-group">
                      {{ Form::text('genre', $genre->name, array('class' => 'form-control')) }}
                      <span class="input-group-btn">
                        {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
                      </span>
                    </div>
                </div>
                {{ Form::close() }}
              </div>
              
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
