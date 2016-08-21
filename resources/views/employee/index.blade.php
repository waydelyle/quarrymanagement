@extends('layouts.master')

@section('title', 'Vehicles')

@section('scripts')
    <script src="{{ asset('js/employee.js') }}"></script>
@endsection

@section('menu')
    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addVehicles">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
    </button>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title pull-left">
                        <span class="glyphicon glyphicon-scale" aria-hidden="true"></span>
                        Employees
                    </h3>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>ID Number</th>
                            <th>Salary</th>
                        </tr>
                        </thead>
                        <tbody id="employee-table-body">
                          <tr>
                              <td></td>
                              <td>
                                  @if(Auth::user()->admin)
                                  @endif
                              </td>
                          </tr>
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
                    <h4 class="modal-title">Add Employee</h4>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ url('auth/register') }}">
                      {!! csrf_field() !!}

                      <div class="form-group">
                          <input type="text" name="name" placeholder="First Name" class="form-control" value="{{ old('name') }}" required>
                      </div>

                      <div class="form-group">
                          <input type="text" name="surname" placeholder="Surname" class="form-control" value="{{ old('name') }}" required>
                      </div>

                      <div class="form-group">
                          <input type="email" name="email" placeholder="Email" class="form-control" value="{{ old('email') }}" required>
                      </div>

                      <div class="form-group">
                          <input type="number" name="surname" placeholder="Surname" class="form-control" value="{{ old('name') }}" required>
                      </div>

                      <div class="form-group">
                          <input type="number" name="surname" placeholder="Surname" class="form-control" value="{{ old('name') }}" required>
                      </div>

                      <div class="text-center">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-primary">Add Employee</button>
                      </div>
                  </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

@endsection
