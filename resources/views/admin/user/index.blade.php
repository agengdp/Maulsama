@extends('layouts.app')

@section('title', 'Users')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          Users
          @can('add_users')
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-xs pull-right">Create New User</a>
          @endcan
        </div>
        <!-- /.panel-heading clearfix -->
        <div class="panel-body">

          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($users as $user)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td width="70%">{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->roles->implode('name', ', ') }}</td>
                  <td>
                    @can('edit_users')
                      <a href="{{ route('users.edit', $user->id) }}" class="btn btn-default btn-xs">Edit</a>
                    @endcan
                    @can('delete_users')
                      <a href="{{ route('users.destroy', $user->id) }}" class="btn btn-danger btn-xs" data-method="delete" data-token="{{ csrf_token() }}" data-confirm="Yakin ingin menghapus user ini ?">Delete</a>
                    @endcan
                  </td>
                </tr>
              @empty
                <tr>
                  <td class="text-center" colspan="5">
                    Tidak ada Users
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
