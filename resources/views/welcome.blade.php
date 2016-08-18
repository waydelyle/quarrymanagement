@extends('layouts.master')

@section('title', 'Home')

@section('styles')
    <style>
        .img-responsive {
            margin: 0 auto;
        }
    </style>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron text-center">
                <img class="img-rounded img-responsive" src="{{ asset('/img/logo.png') }}" >
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