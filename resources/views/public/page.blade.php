@extends('layouts.frontend')

@section('content')
  <div class="main-content main-content--page">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
            <h1 class="page-title">
              {{ $page->title }}
            </h1>
            <hr class="page-hr">
          <div class="page-content">
            {!! $page->content !!}
          </div>
          <!-- /.page-content -->
        </div>
        <!-- /.col-md-12 -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.main-content -->
@endsection
