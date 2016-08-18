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
                                <label class="sr-only" for="amount">Oil</label>
                                <div class="input-group">
                                    @if($diesel->vehicle_id == 1)
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
                                        <input type="number" class="form-control" name="meter" id="meter" value="@if( ! empty($diesel)){{ $diesel->meter }}@endif" placeholder="Meter Reading">
                                        <div class="input-group-addon"> Reading </div>
                                    @else
                                        <div class="input-group-addon">Diesel</div>
                                        <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount" value="{{ $diesel->amount }}">
                                        <div class="input-group-addon">Litres</div>
                                    @endif
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