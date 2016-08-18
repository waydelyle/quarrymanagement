@extends('layouts.master')

@section('title', 'Oil')

@section('scripts')
    <script src="{{ asset('js/oil.js') }}"></script>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title pull-left">
                        <span class="glyphicon glyphicon-tint" aria-hidden="true"></span>
                        Oil
                    </h3>

                    <div class="text-center">
                        <a class="btn btn-default" href="{{ url('history') }}" role="button">
                            History
                        </a>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addOil">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
                        </button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#subtractOil">
                            <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Subtract
                        </button>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#oilTotals">
                            <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Stock
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">

                    <table class="table table-hover" id="oil-table">
                        <thead>
                        <tr>
                            <th>Vehicle</th>
                            <th>Oil</th>
                            <th>Action</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Auth</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Vehicle</th>
                            <th>Oil</th>
                            <th>Action</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Auth</th>
                            <th>Delete</th>
                        </tr>
                        </tfoot>
                        <tbody id="oil-table-body">
                        @if(!empty($oil))
                            @foreach($oil as $row)
                                <tr>
                                    <td>@if($row->vehicle->registration != 'no-vehicle'){{ $row->vehicle->registration }}@endif</td>
                                    <td>{{ $row->type->label }}</td>
                                    <td>@if($row->amount > 0)<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>@else <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> @endif</td>
                                    <td>{{ $row->amount }}</td>
                                    <td>{{ $row->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $row->created_at->format('H:m') }}</td>
                                    <td>{{ $row->user->name }} {{ $row->user->surname }}</td>
                                    <td>
                                        <button type="button" class="btn btn-xs btn-danger disabled">
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

    <!-- Add Oil Modal -->
    <div class="modal fade text-center" id="addOil" role="dialog" data-backdrop="false">
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
                                <div class="input-group-addon">
                                    <label for="type_id">
                                        <select name="oil_type_id">
                                            @if(!empty($oilTypes))
                                                @foreach($oilTypes as $type)
                                                    <option value="{{ $type->id }}">{{ $type->label }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </label>
                                </div>
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

    <!-- Subtract Oil Modal -->
    <div class="modal fade text-center" id="subtractOil" role="dialog" data-backdrop="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Subtract Oil</h4>
                </div>
                <div class="modal-body">
                    <form class="form-inline" id="subtract-oil-form">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <label for="vehicle_id">
                                        <select name="vehicle_id" class="vehicle-select">
                                            @if(!empty($vehicles))
                                                @foreach($vehicles as $vehicle)
                                                    <option class="vehicle-{{ $vehicle->id }}" value="{{ $vehicle->id }}">{{ $vehicle->registration }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </label>
                                </div>
                                <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount">
                                <div class="input-group-addon">
                                    <label for="type_id">
                                        <select name="oil_type_id">
                                            @if(!empty($oilTypes))
                                                @foreach($oilTypes as $type)
                                                    <option value="{{ $type->id }}">{{ $type->label }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </label>
                                </div>
                                <div class="input-group-addon"> Litres </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger" id="subtract-oil-submit" data-dismiss="modal">Subtract</button>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <!-- Oil Totals Modal -->
    <div class="modal fade text-center" id="oilTotals" role="dialog" data-backdrop="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Oil Totals</h4>
                </div>
                <div class="modal-body">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Type<th>
                                    <th>Litres<th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($calculatedOil as $label => $amount)
                                        <tr>
                                            <th>{{ $label }}<th>
                                            <th class="text-info">{{ $amount }} Litres<th>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
@endsection