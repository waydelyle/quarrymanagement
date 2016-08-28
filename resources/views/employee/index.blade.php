@extends('layouts.master')

@section('title', 'Vehicles')

@section('styles')
    <style>
        .photo {
            max-height: 5em;
        }
    </style>
@endsection

@section('scripts')
    <script src="{{ asset('js/employee.js') }}"></script>
@endsection

@include('stock.menu')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title pull-left">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
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
                            <th>Email</th>
                            <th>Salary</th>
                            <th>Manage</th>
                        </tr>
                        </thead>
                        <tbody id="employee-table-body">
                            @if(!empty($employees))
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>@if(empty($employee->photo)) <h1><i class="glyphicon glyphicon-user"></i></h1> @else <img class="img-thumbnail img-responsive photo" src="{{ asset('employee_photos/' . $employee->photo) }}">@endif</td>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->surname }}</td>
                                        <td>{{ $employee->id_number }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>R {{ $employee->salary }}</td>
                                        <td>
                                            @if(Auth::user()->admin)
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer text-center">
                    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addEmployee">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('modals')

    <!-- Add Vehicle Modal -->
    <div class="modal fade text-center" id="addEmployee" role="dialog" data-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Employee</h4>
                </div>
                <div class="modal-body">
                  <form method="POST" enctype="multipart/form-data" action="{{ url('employee/add') }}">
                      {!! csrf_field() !!}

                      <div class="form-group">
                          <input type="text" name="name" placeholder="First Name" class="form-control">
                      </div>

                      <div class="form-group">
                          <input type="text" name="surname" placeholder="Surname" class="form-control">
                      </div>

                      <div class="form-group">
                          <input type="email" name="email" placeholder="Email" class="form-control">
                      </div>

                      <div class="form-group">
                          <div class="input-group">
                              <div class="input-group-addon">Photo</div>
                              <input type="file" name="photo" id="photo" class="form-control">
                          </div>
                      </div>

                      <div class="form-group">
                          <input type="number" name="id_number" placeholder="ID Number" class="form-control" required>
                      </div>

                      <div class="form-group">
                          <input type="number" name="salary" placeholder="Salary, for example 10 000.00." class="form-control">
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
