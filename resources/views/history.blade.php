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
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#diesel-history" id="view-diesel-history">Diesel</a></li>
                        <li><a data-toggle="tab" href="#oil-history" id="view-oil-history">Oil</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="diesel-history" class="tab-pane fade in active">
                            <table class="table table-hover" id="diesel-history-table">
                                <thead>
                                <tr>
                                    <th>Vehicle</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Authorized by</th>
                                </tr>
                                </thead>
                                <tbody id="diesel-history-table-body">
                                </tbody>
                            </table>
                        </div>
                        <div id="oil-history" class="tab-pane fade">
                            <table class="table table-hover" id="oil-history-table">
                                <thead>
                                <tr>
                                    <th>Vehicle</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Authorized by</th>
                                </tr>
                                </thead>
                                <tbody id="oil-history-table-body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-center">
                    <form class="form-inline" id="view-history-form">
                        <div class="form-group">
                            <label class="sr-only" for="amount">Date</label>
                            <div class="input-group">
                                <div class="input-group-addon">From</div>
                                <input type="date" class="form-control" name="fromDate" id="fromDate">
                            </div>
                            <div class="input-group">
                                <div class="input-group-addon">To</div>
                                <input type="date" class="form-control" name="toDate" id="toDate">
                            </div>
                        </div>
                        <button class="btn btn-default" type="submit" id="view-diesel-history" role="button">View Diesel History</button>
                        <button class="btn btn-default" type="submit" id="view-oil-history" role="button">View Oil History</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection