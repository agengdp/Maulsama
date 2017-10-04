@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                  Jumlah Series
                  <button class="btn btn-primary btn-xs pull-right" type="button" name="button">New Series</button>
                </div>

                <div class="panel-body">
                    {{ count($data['media']['series']) }}
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                  Jumlah Movies
                  <button class="btn btn-primary btn-xs pull-right" type="button" name="button">New Movies</button>
                </div>

                <div class="panel-body">
                    {{ count($data['media']['movies']) }}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                  Last Published (Series & Movies)
                  {{-- <button class="btn btn-primary btn-xs pull-right" type="button" name="button">New Series</button> --}}
                </div>

                <div class="panel-body">
                    @forelse($data['media']['last'] as $last)
                      <span class="label label-default">{{ $loop->iteration }}</span>
                        {{ $last->title }}
                    @empty
                        Empty
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading clearfix">
              Last Episode Uploaded
            </div>
            <!-- /.panel-heading clearfix -->
            <div class="panel-body">
                hahahaha
            </div>
            <!-- /.panel-body -->
          </div>
          <!-- /.panel panel-dafault -->
        </div>
        <!-- /.col-md-12 -->
    </div>
@endsection
