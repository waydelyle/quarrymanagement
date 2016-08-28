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
                        Stock Usage
                    </h3>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Stock Item</th>
                            <th>Employee</th>
                            <th>Job</th>
                            <th>description</th>
                            <th>amount</th>
                        </tr>
                        </thead>
                        <tbody id="employee-table-body">
                            @if(!empty($stock))
                                @foreach($stock as $usage)
                                    <tr>
                                        <td>@if(!empty($usage->item)){{ $usage->item->label }} @else example item @endif</td>
                                        <td>{{ $usage->employee->name }} {{ $usage->employee->surname }}</td>
                                        <td>{{ $usage->job->label }}</td>
                                        <td>{{ $usage->description }}</td>
                                        <td>{{ $usage->amount }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer text-center">
                    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#record-usage">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Record Usage
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('modals')

    <!-- Add Vehicle Modal -->
    <div class="modal fade text-center" id="record-usage" role="dialog" data-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Record Stock Usage</h4>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ url('stock-usage/add') }}">
                      {!! csrf_field() !!}

                      <div class="form-group">
                          <div class="input-group">
                              <div class="input-group-addon"> Employee </div>
                              <select class="form-control" name="employee_id" title="Employee">
                                  @if(!empty($employees))
                                      @foreach($employees as $employee)
                                          <option value="{{ $employee->id }}">{{ $employee->name }} {{ $employee->surname }}</option>
                                      @endforeach
                                  @endif
                              </select>
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="input-group">
                              <div class="input-group-addon"> Stock Item </div>
                              <select class="form-control" name="stock_item_id" title="Stock Item">
                              @if(!empty($stockItems))
                                  @foreach($stockItems as $item)
                                      <option value="{{ $item->id }}">{{ $item->label }}</option>
                                  @endforeach
                              @endif
                          </select>
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="input-group">
                              <div class="input-group-addon"> Job </div>
                              <select class="form-control" name="job_id" title="Job">
                                  @if(!empty($jobs))
                                      @foreach($jobs as $job)
                                          <option value="{{ $job->id }}">{{ $job->label }}</option>
                                      @endforeach
                                  @endif
                              </select>
                          </div>
                      </div>

                      <div class="form-group">
                          <textarea name="description" placeholder="description" class="form-control" required></textarea>
                      </div>

                      <div class="form-group">
                          <input type="number" name="amount" placeholder="Amount used" class="form-control" required>
                      </div>

                      <div class="text-center">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-primary">Add Usage</button>
                      </div>
                  </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

@endsection
