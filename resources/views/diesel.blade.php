@extends('layouts.master')

@section('title', 'Diesel')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-oil" aria-hidden="true"></span>
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
    </div>

@endsection

@section('modals')

    <!-- Add Diesel Modal -->
    <div class="modal fade text-center" id="addDiesel" role="dialog" data-backdrop="false">
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
    <div class="modal fade text-center" id="subtractDiesel" role="dialog" data-backdrop="false">
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

@endsection