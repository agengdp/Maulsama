@extends('layouts.app')
@section('title', 'Pages')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        Pages
        <a href="{{ route('pages.create') }}" class="btn btn-primary btn-xs pull-right">New Page</a>
      </div>
      <!-- /.panel panel-heading clearfix -->
      <div class="panel-body">

      </div>
      <!-- /.panel-body -->
    </div>
    <!-- /.panel panel-default -->
  </div>
  <!-- /.col-md-12 -->
</div>
<!-- /.row -->
@endsection
