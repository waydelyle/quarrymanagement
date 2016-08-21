@extends('layouts.master')

@section('title', 'Diesel')

@section('scripts')
    <script src="{{ asset('js/diesel.js') }}"></script>
@endsection

@section('menu')
    <a class="btn btn-default btn-lg" href="{{ url('history') }}" role="button">
        History
    </a>
    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addDiesel">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
    </button>
    <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#subtractDiesel">
        <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Subtract
    </button>
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#dieselTotals">
        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Stock
    </button>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title pull-left">
                        <span class="glyphicon glyphicon-oil" aria-hidden="true"></span>
                        Diesel
                    </h3>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">

                    <table class="table table-hover" id="diesel-table">
                        <thead>
                        <tr>
                            <th>Vehicle</th>
                            <th>Amount</th>
                            <th class="visible-md visible-lg">Action</th>
                            <th>Meter Reading</th>
                            <th class="visible-sm visible-md visible-lg">Date</th>
                            <th class="visible-md visible-lg">Time</th>
                            <th class="visible-md visible-lg">Auth</th>
                            <th class="visible-md visible-lg">Manage</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Vehicle</th>
                            <th>Amount</th>
                            <th class="visible-md visible-lg">Action</th>
                            <th>Meter Reading</th>
                            <th class="visible-sm visible-md visible-lg">Date</th>
                            <th class="visible-md visible-lg">Time</th>
                            <th class="visible-md visible-lg">Auth</th>
                            <th class="visible-md visible-lg">Manage</th>
                        </tr>
                        </tfoot>
                        <tbody id="diesel-table-body">
                        @if(!empty($diesel))
                            @foreach($diesel as $row)
                                <tr>
                                    <td>@if($row->vehicle->registration != 'no-vehicle'){{ $row->vehicle->registration }}@endif</td>
                                    <td>{{ $row->amount }}</td>
                                    <td class="visible-md visible-lg">@if($row->amount > 0)<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>@else <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> @endif</td>
                                    <td>{{ $row->meter }}</td>
                                    <td class="visible-sm visible-md visible-lg">{{ $row->created_at->format('Y-m-d') }}</td>
                                    <td class="visible-md visible-lg">{{ $row->created_at->format('H:m') }}</td>
                                    <td class="visible-md visible-lg">{{ $row->user->name }} {{ $row->user->surname }}</td>
                                    <td class="visible-md visible-lg">
                                        @if(Auth::user()->admin)
                                            <a type="button" class="btn btn-xs btn-success edit-diesel diesel-{{ $row->id }}" href="{{ url('diesel/update/' . $row->id) }}">
                                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit
                                            </a>
                                            <button type="button" class="btn btn-xs btn-danger delete-diesel diesel-{{ $row->id }}" id="{{ $row->id }}">
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-xs btn-danger disabled">
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete
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
                                <input type="number" class="form-control" name="amount" id="diesel-amount"  placeholder="Amount">
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
                                <select name="vehicle_id" class="form-control" title="Vehicle">
                                    @if(!empty($vehicles))
                                        @foreach($vehicles as $vehicle)
                                            <option class="vehicle-{{ $vehicle->id }}" value="{{ $vehicle->id }}">{{ $vehicle->registration }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="input-group-addon"> Vehicle </div>
                                <input type="number" class="form-control" name="meter" id="meter" value="@if( ! empty($meter)){{ $meter->meter }}@endif" placeholder="Meter Reading">
                                <div class="input-group-addon"> Reading </div>
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

    <!-- Diesel Totals Modal -->
    <div class="modal fade text-center" id="dieselTotals" role="dialog" data-backdrop="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Diesel Total</h4>
                </div>
                <div class="modal-body">
                    <h4 class="text-info">@if( ! empty($stock)) {{ $stock }} Litres @endif </h4>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
@endsection