@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                  Jumlah Series
                  <button class="btn btn-primary btn-xs pull-right" type="button" name="button">New Series</button>
                </div>

                <div class="panel-body">
                    {{$jumlah_series}}
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
                    You are logged in!
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                  Last Published
                  <button class="btn btn-primary btn-xs pull-right" type="button" name="button">New Series</button>
                </div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
@endsection
