@extends('layouts.master')

@section('title', 'Vehicles')

@section('scripts')
    <script src="{{ asset('js/job.js') }}"></script>
@endsection

@include('stock.menu')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title pull-left">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        Stock Types
                    </h3>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Label</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody id="employee-table-body">
                            @if(!empty($stockTypes))
                                @foreach($stockTypes as $type)
                                    <tr>
                                        <td>{{ $type->label }}</td>
                                        <td>{{ $type->description }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer text-center">
                    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#add-stock-type">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('modals')

    <!-- Add Vehicle Modal -->
    <div class="modal fade text-center" id="add-stock-type" role="dialog" data-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Stock Type</h4>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ url('stock-type/add') }}">
                      {!! csrf_field() !!}

                      <div class="form-group">
                          <input type="text" name="label" placeholder="label" class="form-control" required>
                      </div>

                      <div class="form-group">
                          <textarea name="description" placeholder="description" class="form-control" required></textarea>
                      </div>

                      <div class="text-center">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-primary">Add Stock Type</button>
                      </div>
                  </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

@endsection
