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
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-scale" aria-hidden="true"></span>
                        Vehicles
                        <span class="pull-right">
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

    <!-- Add Vehicle Modal -->
    <div class="modal fade text-center" id="addVehicles" role="dialog" data-backdrop="false">
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