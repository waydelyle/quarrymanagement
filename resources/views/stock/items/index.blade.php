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
                        Stock Items
                    </h3>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Label</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Manage</th>
                        </tr>
                        </thead>
                        <tbody id="employee-table-body">
                            @if(!empty($stockItems))
                                @foreach($stockItems as $item)
                                        <tr>
                                        <td>{{ $item->label }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->type->label }}</td>
                                        <td>{{ $item->count }}
                                            <a type="button" class="btn btn-xs btn-success" href="{{ url('stock-item/addStock/' . $item->id) }}">
                                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                            </a>
                                        </td>
                                        <td>
                                            <a type="button" class="btn btn-xs btn-success" href="{{ url('stock-item/update/' . $item->id) }}">
                                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit
                                            </a>
                                            @if(Auth::user()->admin)
                                                <a type="button" class="btn btn-xs btn-danger" href="{{ url('stock-item/delete/' . $item->id) }}">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer text-center">
                    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#add-stock-item">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('modals')

    <!-- Add Vehicle Modal -->
    <div class="modal fade text-center" id="add-stock-item" role="dialog" data-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Stock Item</h4>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ url('stock-item/add') }}">
                      {!! csrf_field() !!}

                      <div class="form-group">
                          <input type="text" name="label" placeholder="label" class="form-control" required>
                      </div>

                      <div class="form-group">
                          <textarea name="description" placeholder="description" class="form-control" required></textarea>
                      </div>

                      <div class="form-group">
                          <div class="input-group">
                              <div class="input-group-addon"> Type </div>
                              <select class="form-control" name="stock_type_id" title="Stock Type">
                                  @if(!empty($stockTypes))
                                      @foreach($stockTypes as $type)
                                          <option value="{{ $type->id }}">{{ $type->label }}</option>
                                      @endforeach
                                  @endif
                              </select>
                          </div>
                      </div>

                      <div class="form-group">
                          <input type="number" name="amount" placeholder="Amount" class="form-control" required>
                      </div>

                      <div class="text-center">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-primary">Add Stock Item</button>
                      </div>
                  </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

@endsection
