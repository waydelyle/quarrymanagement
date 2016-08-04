@extends('layouts.master')

@section('title', 'History')

@section('scripts')
    <script src="{{ asset('/js/history.js') }}"></script>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                        History
                    </h3>
                </div>
                <div class="panel-body">

                    <div class="pull-right">
                        <form class="form-inline pull-right" id="add-oil-form">
                            <div class="form-group">
                                <label class="sr-only" for="amount">Date</label>
                                <div class="input-group">
                                    <div class="input-group-addon">From</div>
                                    <input type="date" class="form-control" name="amount" id="amount" placeholder="Amount">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-addon">To</div>
                                    <input type="date" class="form-control" name="amount" id="amount" placeholder="Amount">
                                </div>
                            </div>
                            <a class="btn btn-default" href="#" role="button">View History</a>
                        </form>
                    </div>

                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#diesel-chart">Diesel</a></li>
                        <li><a data-toggle="tab" href="#oil-chart">Oil</a></li>
                        <li><a data-toggle="tab" href="#vehicle-chart">Vehicles</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="diesel-chart" class="tab-pane fade in active">
                            <div id="chart_div"></div>
                        </div>
                        <div id="oil-chart" class="tab-pane fade">
                            <div id="chart_div"></div>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-center">

                </div>
            </div>
        </div>
    </div>

@endsection