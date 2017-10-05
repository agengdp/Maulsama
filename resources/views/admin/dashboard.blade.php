@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                  Statistics
                  {{-- <button class="btn btn-primary btn-xs pull-right" type="button" name="button">New Series</button> --}}
                </div>

                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="list__statistic">
                        Series
                      </div>
                      <div class="list__statistic list__statistic--count">
                        {{ count($data['media']['series']) }}
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="list__statistic">
                        Movies
                      </div>
                      <div class="list__statistic list__statistic--count">
                        {{ count($data['media']['movies']) }}
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="list__statistic">
                        Episode
                      </div>
                      <div class="list__statistic list__statistic--count">
                        {{ $data['media']['episodesAll'] }}
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                  Last Published (Series & Movies)
                  {{-- <button class="btn btn-primary btn-xs pull-right" type="button" name="button">New Series</button> --}}
                </div>

                <div class="panel-body">
                    @forelse($data['media']['last'] as $last)
                      <div class="list">
                        <div class="list list__published">
                          <div class="list list__published list__published--number">
                            {{ $loop->iteration }}
                          </div>
                          <div class="list list__published list__published--title">
                            {{ $last->title }}
                          </div>
                        </div>
                      </div>
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
                @forelse ($data['media']['episodes'] as $episode)
                  <div class="list">
                    <div class="list list__last_uploaded">
                      <div class="list list__last_uploaded--number">
                        {{ $loop->iteration }}
                      </div>
                      <div class="list list__last_uploaded--series">
                        {{ $episode->series->title }}
                      </div>
                      <div class="list list__last_uploaded--title">
                        {{ $episode->judul_episode }}
                      </div>
                    </div>
                  </div>
                @empty

                @endforelse
            </div>
            <!-- /.panel-body -->
          </div>
          <!-- /.panel panel-dafault -->
        </div>
        <!-- /.col-md-12 -->
    </div>
@endsection
