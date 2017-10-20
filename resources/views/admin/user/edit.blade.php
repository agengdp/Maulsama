@extends('layouts.app')

@section('title', $heading)

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          Users
            <a href="{{ route('users.index') }}" class="btn btn-primary btn-xs pull-right">Back</a>
        </div>
        <!-- /.panel-heading clearfix -->
        <div class="panel-body">

          {{ Form::open(['route' => ['users.update', $user->id], 'method' => 'PUT']) }}

          <div class="form-group @if ($errors->has('name')) has-error @endif">
            {{ Form::label('name', 'Nama') }}
            {{ Form::text('name', $user->name, ['class' => 'form-control', 'required' => 'required']) }}
            @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
          </div>

          <div class="form-group @if ($errors->has('email')) has-error @endif">
            {{ Form::label('email', 'Email') }}
            {{ Form::text('email', $user->email, ['class' => 'form-control', 'required' => 'required']) }}
            @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
          </div>

          <div class="form-group @if ($errors->has('bio')) has-error @endif">
            {{ Form::label('bio', 'Bio') }}
            {{ Form::textarea('bio', $user->bio, ['class' => 'form-control', 'required' => 'required']) }}
            @if ($errors->has('bio')) <p class="help-block">{{ $errors->first('bio') }}</p> @endif
          </div>

          <div class="form-group @if ($errors->has('password')) has-error @endif">
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password', ['class' => 'form-control']) }}
            @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
          </div>

          <div class="form-group @if ($errors->has('role')) has-error @endif">
            {{ Form::label('role', 'Roles') }}
            {{ Form::select('role', $roles, isset($user) ? $user->roles->pluck('id')->toArray() : null,  ['class' => 'form-control']) }}
            @if ($errors->has('role')) <p class="help-block">{{ $errors->first('roles') }}</p> @endif
          </div>
          {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
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
