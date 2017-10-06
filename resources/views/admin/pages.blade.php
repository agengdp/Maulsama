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
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Published</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($pages as $page)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td width="70%">{{ $page->title }}</td>
                <td>{{ $page->created_at }}</td>
                <td>
                  <a href="{{ route('pages.edit', $page->id) }}" class="btn btn-default btn-xs">Edit</a>
                  <a href="{{ route('pages.destroy', $page->id) }}" class="btn btn-danger btn-xs" data-method="delete" data-token="{{ csrf_token() }}" data-confirm="Yakin ingin menghapus page ini ?">Delete</a>
                </td>
              </tr>
            @empty
              <tr>
                <td class="text-center" colspan="4">
                  Tidak ada halaman yang dibuat...
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
        <!-- /.table table-hover table-bordered -->
      </div>
      <!-- /.panel-body -->
    </div>
    <!-- /.panel panel-default -->
  </div>
  <!-- /.col-md-12 -->
</div>
<!-- /.row -->
@endsection
