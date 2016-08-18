@extends('layouts.master')

@section('title', 'Vehicles')

@section('scripts')
    <script src="{{ asset('js/vehicles.js') }}"></script>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title pull-left">
                        <span class="glyphicon glyphicon-scale" aria-hidden="true"></span>
                        {{ $oil->amount }} {{ $oil->type->label }} {{ $oil->created_at }}
                    </h3>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                        <form class="form-inline text-center">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label class="sr-only" for="amount">Oil</label>
                                <div class="input-group">
                                    @if($oil->vehicle_id != 1)
                                    <div class="input-group-addon">
                                            <label for="vehicle_id">
                                                <select name="vehicle_id" class="vehicle-select">
                                                    @if(!empty($vehicles))
                                                        @foreach($vehicles as $vehicle)
                                                            <option value="{{ $vehicle->id }}">{{ $vehicle->registration }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </label>
                                    </div>
                                    @endif
                                    <div class="input-group-addon">Oil</div>
                                    <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount" value="{{ $oil->amount }}">
                                    <div class="input-group-addon">Litres</div>
                                    <div class="input-group-addon">
                                        <label for="type_id">
                                            <select name="oil_type_id" value="{{ $oil->id }}">
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
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Save</button>
                        </form>
                </div>
                <div class="panel-footer text-center">
                    <a type="button" class="btn btn-xs btn-warning" href="{{ url('oil') }}">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection