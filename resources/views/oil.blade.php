@extends('layouts.master')

@section('title', 'Oil')

@section('scripts')
    <script src="{{ asset('js/oil.js') }}"></script>
@endsection

@section('menu')
    <a class="btn btn-default btn-lg" href="{{ url('history') }}" role="button">
        History
    </a>
    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addOil">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
    </button>
    <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#subtractOil">
        <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Subtract
    </button>
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#oilTotals">
        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Stock
    </button>
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
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">

                    <table class="table table-hover table-responsive" id="oil-table">
                        <thead>
                        <tr>
                            <th>Vehicle</th>
                            <th>Oil</th>
                            <th class="visible-md visible-lg">Action</th>
                            <th>Amount</th>
                            <th class="visible-sm visible-md visible-lg">Date</th>
                            <th class="visible-md visible-lg">Time</th>
                            <th class="visible-md visible-lg">Auth</th>
                            <th class="visible-md visible-lg">Manage</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Vehicle</th>
                            <th>Oil</th>
                            <th class="visible-md visible-lg">Action</th>
                            <th>Amount</th>
                            <th class="visible-sm visible-md visible-lg">Date</th>
                            <th class="visible-md visible-lg">Time</th>
                            <th class="visible-md visible-lg">Auth</th>
                            <th class="visible-md visible-lg">Manage</th>
                        </tr>
                        </tfoot>
                        <tbody id="oil-table-body">
                        @if(!empty($oil))
                            @foreach($oil as $row)
                                <tr>
                                    <td>@if($row->vehicle->registration != 'no-vehicle'){{ $row->vehicle->registration }}@endif</td>
                                    <td>{{ $row->type->label }}</td>
                                    <td class="visible-md visible-lg">@if($row->amount > 0)<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>@else <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> @endif</td>
                                    <td>{{ $row->amount }}</td>
                                    <td class="visible-sm visible-md visible-lg">{{ $row->created_at->format('Y-m-d') }}</td>
                                    <td class="visible-md visible-lg">{{ $row->created_at->format('H:m') }}</td>
                                    <td class="visible-md visible-lg">{{ $row->user->name }} {{ $row->user->surname }}</td>
                                    <td class="visible-md visible-lg">
                                        @if(Auth::user()->admin)
                                            <a type="button" class="btn btn-xs btn-success edit-oil oil-{{ $row->id }}" href="{{ url('oil/update/' . $row->id) }}">
                                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit
                                            </a>
                                            <button type="button" class="btn btn-xs btn-danger delete-oil oil-{{ $row->id }}" id="{{ $row->id }}">
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-xs btn-danger disabled">
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                            </button>
                                        @endif
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
                                <select class="form-control" name="oil_type_id" title="Oil Type">
                                    @if(!empty($oilTypes))
                                        @foreach($oilTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->label }}</option>
                                        @endforeach
                                    @endif
                                </select>
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
                                <select name="vehicle_id" class="form-control" title="Vehicle">
                                    @if(!empty($vehicles))
                                        @foreach($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}">{{ $vehicle->registration }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="input-group-addon"> Vehicle </div>
                                <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount">
                                <div class="input-group-addon"> Litres </div>
                                <select class="form-control" name="oil_type_id" title="Oil Type">
                                    @if(!empty($oilTypes))
                                        @foreach($oilTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->label }}</option>
                                        @endforeach
                                    @endif
                                </select>
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