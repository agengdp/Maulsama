@extends('layouts.app')

@section('title', 'Create New Page')

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
  {{-- Ini adalah emmet template untuk membuat page frame baru --}}
  {{-- .row>.col-md-12>.panel.panel-default>.panel-heading.clearfix>a.btn.btn-primary.btn-xs.pull-right^.panel-body|c --}}

  <div class="row">

    <div class="col-md-12">

      <div class="panel panel-default">

        <div class="panel-heading clearfix">
          Create New Page
          <a href="{{ route('pages.index') }}" class="btn btn-primary btn-xs pull-right">Back</a>
        </div>
        <!-- /.panel panel-heading clearfix -->

        <div class="panel-body">
          <div class="row">
            {{ Form::open(array('route' => 'pages.store')) }}
            <div class="col-md-9">
              {{ Form::label('title', 'Title') }}
              {{ Form::text('title', null, array('class' => 'form-control', 'required', '')) }}
              {{ Form::label('description', 'Meta Description') }}
              {{ Form::text('description', null, array('class' => 'form-control', 'required', '')) }}
              {{ Form::label('keywords', 'Meta Keywords') }}
              {{ Form::text('keywords', null, array('class' => 'form-control', 'required', '')) }}
              {{ Form::label('content', 'Page Body') }}
              {{ Form::textarea('content', null, array('class' => 'form-control')) }}
            </div>
            <!-- /.col-md-9 -->
            <div class="col-md-3">
              <div class="well">
                {{ Form::submit('Publish', array('class' => 'btn btn-primary btn-lg btn-block')) }}
              </div>
              <!-- /.panel -->
            </div>
            <!-- /.col-md-3 -->
            {{ Form::close() }}
          </div>
          <!-- /.row -->
        </div>
        <!-- /.panel-body -->

      </div>
      <!-- /.panel panel-default -->

    </div>
    <!-- /.col-md-12 -->

  </div>
  <!-- /.row -->
@endsection
