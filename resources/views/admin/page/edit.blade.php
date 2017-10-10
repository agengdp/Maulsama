@extends('layouts.app')

@section('title', $heading)

@section('beforehead')
      <script src="{{ asset('storage/assets/vendor/tinymce/tinymce.min.js') }}"></script>
      <script type="text/javascript">
        tinymce.init({
          selector: 'textarea#content',
          plugins: 'code link lists table',

        });
      </script>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        {{ $heading }}
        <a href="{{ route('pages.index') }}" class="btn btn-primary btn-xs pull-right">Back</a>
      </div>
      <!-- /.panel-heading clearfix -->
      <div class="panel-body">
        <div class="row">
          {{ Form::open(array('method' => 'PUT', 'route' => ['pages.update', $page->id])) }}
          <div class="col-md-9">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', $page->title, array('class' => 'form-control', 'required', '')) }}
            {{ Form::label('description', 'Meta Description') }}
            {{ Form::text('description', $page->description, array('class' => 'form-control', 'required', '')) }}
            {{ Form::label('keywords', 'Meta Keywords') }}
            {{ Form::text('keywords', $page->keywords, array('class' => 'form-control', 'required', '')) }}
            {{ Form::label('content', 'Page Body') }}
            {{ Form::textarea('content', $page->content, array('class' => 'form-control')) }}
          </div>
          <!-- /.col-md-9 -->
          <div class="col-md-3">
            <div class="well">
              {{ Form::submit('Update', array('class' => 'btn btn-primary btn-lg btn-block')) }}
            </div>
            <!-- /.panel -->
          </div>
          <!-- /.col-md-3 -->
          {{ Form::close() }}
      </div>
      <!-- /.panel-body -->
    </div>
    <!-- /.panel panel-default -->
  </div>
  <!-- /.col-md-12 -->
</div>
<!-- /.row -->
@endsection
