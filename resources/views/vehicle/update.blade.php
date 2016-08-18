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
                        {{ $vehicle->registration }}
                    </h3>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                        @if(!empty($vehicle))
                            <form class="form-inline text-center">
                                {!! csrf_field() !!}

                                <div class="form-group">
                                    <label class="sr-only" for="amount">Registration</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">Registration number</div>
                                        <input type="text" class="form-control" name="registration" placeholder="Registration number" value="{{ $vehicle->registration }}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Save</button>
                            </form>
                        @endif
                </div>
                <div class="panel-footer text-center">
                    <a type="button" class="btn btn-xs btn-warning" href="{{ url('vehicles') }}">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection