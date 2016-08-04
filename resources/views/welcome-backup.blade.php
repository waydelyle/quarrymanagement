@extends('layouts.master')

@section('title', 'Home')

@section('content')

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="page-header">
        <div class="container">
            <h1>
                Quarry Management System
                <span class="glyphicon glyphicon-leaf" aria-hidden="true"></span>
            </h1>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon glyphicon-stats" aria-hidden="true"></span>
                        Stats
                        <span class="pull-right">
                            <a class="btn btn-xs btn-default" href="#" role="button">View Stats</a>
                        </span>
                    </h3>
                </div>
                <div class="panel-body">

                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">Vehicles</a></li>
                        <li><a data-toggle="tab" href="#menu1">Diesel Today</a></li>
                        <li><a data-toggle="tab" href="#menu2">Oil Today</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Registration</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody class="vehicle-table-body">
                                @if(!empty($vehicles))
                                    @foreach($vehicles as $vehicle)
                                        <tr>
                                            <td>{{ $vehicle->registration }}</td>
                                            <td>
                                                <button type="button" class="btn btn-xs btn-danger delete-vehicle vehicle-{{ $vehicle->id }}" id={{ $vehicle->id }}>
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                    200 Oil Litres Today
                                </div>
                            </div>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                    200 Diesel Litres Today
                                </div>
                            </div>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                            <h3>Menu 2</h3>
                            <p>Some content in menu 2.</p>
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-center">

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Diesel
                        <span class="pull-right">
                            <a class="btn btn-xs btn-default" href="#" role="button">
                                Manage Diesel
                            </a>
                            <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#addDiesel">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </button>
                            <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#subtractDiesel">
                                <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                            </button>
                        </span>
                    </h3>
                </div>
                <div class="panel-body">

                    <table class="table table-hover" id="diesel-table">
                        <thead>
                        <tr>
                            <th>Amount</th>
                            <th>Date added</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody id="diesel-table-body">
                        @if(!empty($diesel))
                            @foreach($diesel as $row)
                                <tr>
                                    <td>{{ $row->amount }}</td>
                                    <td>{{ $row->created_at }}</td>
                                    <td>
                                        <button type="button" class="btn btn-xs btn-danger delete-diesel diesel-{{ $row->id }}" id={{ $row->id }}>
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                </div>
                <div class="panel-footer text-center">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                            100 Litres
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Oil
                        <span class="pull-right">
                            <a class="btn btn-xs btn-default" href="#" role="button">
                                Manage Oil
                            </a>
                            <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#addOil">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </button>
                            <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#subtractOil">
                                <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                            </button>
                        </span>
                    </h3>
                </div>
                <div class="panel-body">

                    <table class="table table-hover" id="oil-table">
                        <thead>
                        <tr>
                            <th>Amount</th>
                            <th>Date added</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody id="oil-table-body">
                        @if(!empty($oil))
                            @foreach($oil as $row)
                                <tr>
                                    <td>{{ $row->amount }}</td>
                                    <td>{{ $row->created_at }}</td>
                                    <td>
                                        <button type="button" class="btn btn-xs btn-danger delete-oil oil-{{ $row->id }}" id={{ $row->id }}>
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                </div>
                <div class="panel-footer text-center">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                            200 Litres
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Vehicles
                        <span class="pull-right">
                            <a class="btn btn-xs btn-default" href="#" role="button">Manage Vehicles</a>
                            <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#addVehicles">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </button>
                        </span>
                    </h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Registration</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody id="vehicle-table-body">
                            @if(!empty($vehicles))
                                @foreach($vehicles as $vehicle)
                                    <tr>
                                        <td>{{ $vehicle->registration }}</td>
                                        <td>
                                            <button type="button" class="btn btn-xs btn-danger delete-vehicle vehicle-{{ $vehicle->id }}" id={{ $vehicle->id }}>
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer text-center">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('modals')
    <!-- Add Diesel Modal -->
    <div class="modal fade text-center" id="addDiesel" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Diesel</h4>
                </div>
                <div class="modal-body">
                    <form class="form-inline" id="add-diesel-form">
                        <div class="form-group">
                            {!! csrf_field() !!}

                            <label class="sr-only" for="amount">Diesel</label>
                            <div class="input-group">
                                <div class="input-group-addon">Diesel</div>
                                <input type="number" class="form-control" name="amount" id="diesel-amount" placeholder="Amount">
                                <div class="input-group-addon">Litres</div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success" id="add-diesel-submit" data-dismiss="modal">Add</button>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <!-- Subtract Diesel Modal -->
    <div class="modal fade text-center" id="subtractDiesel" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Subtract Diesel</h4>
                </div>
                <div class="modal-body">
                    <form class="form-inline" id="subtract-diesel-form">
                        <div class="form-group">
                            <label class="sr-only" for="amount">Diesel</label>
                            <div class="input-group">
                                <div class="input-group-addon"> Vehicle
                                    <select name="vehicle_id" class="vehicle-select">
                                        @if(!empty($vehicles))
                                            @foreach($vehicles as $vehicle)
                                                <option class="vehicle-{{ $vehicle->id }}" value="{{ $vehicle->id }}">{{ $vehicle->registration }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount">
                                <div class="input-group-addon"> Litres </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger" id="subtract-diesel-submit" data-dismiss="modal">Subtract</button>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <!-- Add Oil Modal -->
    <div class="modal fade text-center" id="addOil" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Oil</h4>
                </div>
                <div class="modal-body">
                    <form class="form-inline" id="add-oil-form">
                        <div class="form-group">
                            <label class="sr-only" for="amount">Oil</label>
                            <div class="input-group">
                                <div class="input-group-addon">Oil</div>
                                <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount">
                                <div class="input-group-addon">Litres</div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success" id="add-oil-submit" data-dismiss="modal">Add</button>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <!-- Subtract Diesel Modal -->
    <div class="modal fade text-center" id="subtractOil" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Subtract Oil</h4>
                </div>
                <div class="modal-body">
                    <form class="form-inline">
                        <div class="form-group">
                            <label class="sr-only" for="amount">Oil</label>
                            <div class="input-group">
                                <div class="input-group-addon"> Vehicle
                                    <select name="vehicle_id" class="vehicle-select">
                                        @if(!empty($vehicles))
                                            @foreach($vehicles as $vehicle)
                                                <option class="vehicle-{{ $vehicle->id }}" value="{{ $vehicle->id }}">{{ $vehicle->registration }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount">
                                <div class="input-group-addon"> Litres </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger">Subtract</button>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>


    <!-- Add Vehicle Modal -->
    <div class="modal fade text-center" id="addVehicles" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Vehicle</h4>
                </div>
                <div class="modal-body">
                    <form class="form-inline" id="add-vehicle-form">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="sr-only" for="amount">Registration</label>
                            <div class="input-group">
                                <div class="input-group-addon">Registration number</div>
                                <input type="text" class="form-control" name="registration" placeholder="Registration number" id="registration-text">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success" id="add-vehicle-submit" data-dismiss="modal">Add</button>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
@endsection