@extends('layouts.master')

@section('title', 'Stats')

@section('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{ asset('/js/stats.js') }}"></script>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-stats" aria-hidden="true"></span>
                        Stats
                    </h3>
                </div>
                <div class="panel-body">

                    <ul class="nav nav-tabs">
                        <li class="active"><a id="loadDieselChart" data-toggle="tab" href="#diesel-chart">Diesel</a></li>
                        <li><a id="loadOilChart" data-toggle="tab" href="#oil-chart">Oil</a></li>
                        <li><a id="loadVehicleChart" data-toggle="tab" href="#vehicle-chart">Vehicles</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="diesel-chart" class="tab-pane fade in active">
                            <div id="displayChart"></div>
                        </div>
                        <div id="oil-chart" class="tab-pane fade">
                            <div id="displayChart"></div>
                        </div>
                        <div id="vehicle-chart" class="tab-pane fade">
                            <div id="displayChart"></div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-center">

                </div>
            </div>
        </div>
    </div>

@endsection