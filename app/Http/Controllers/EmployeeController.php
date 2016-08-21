<?php namespace App\Http\Controllers;

class EmployeeController extends Controller
{
    public function index()
    {
      return view('employee.index');
    }

    public function show()
    {
      return view('employee.show');
    }

    public function update()
    {
      return view('employee.update');
    }

    public function create()
    {
      return view('employee.create');
    }

    public function store()
    {

    }

    public function delete()
    {

    }
}
