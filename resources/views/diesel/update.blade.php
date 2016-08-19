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
                        {{ $diesel->amount }} {{ $diesel->created_at }}
                    </h3>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                        <form class="form-inline text-center">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <div class="input-group">
                                <label class="sr-only" for="amount">Oil</label>
                                    @if($diesel->vehicle_id != 1)
                                        <select class="form-control selectpicker" name="vehicle_id" title="Vehicle">
                                            @if(!empty($vehicles))
                                                @foreach($vehicles as $vehicle)
                                                    <option value="{{ $vehicle->id }}">{{ $vehicle->registration }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="input-group-addon"> Vehicle </div>
                                    @endif
                                        <input type="number" class="form-control" name="meter" id="meter" value="@if( ! empty($diesel)){{ $diesel->meter }}@endif" placeholder="Meter Reading">
                                        <div class="input-group-addon"> Reading </div>
                                        <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount" value="{{ $diesel->amount }}">
                                        <div class="input-group-addon">Litres</div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Save</button>
                        </form>
                </div>
                <div class="panel-footer text-center">
                    <a type="button" class="btn btn-xs btn-warning" href="{{ url('diesel') }}">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection