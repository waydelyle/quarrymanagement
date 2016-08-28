<?php namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EmployeeController extends Controller
{
    public function index()
    {
      $employees = Employee::all();

      return view('employee.index', ['employees' => $employees]);
    }

    public function add(Request $request)
    {
        $fileName = null;
        if($request->hasFile('photo')){
            $destinationPath = 'employee_photos'; // upload path
            $extension = $request->file('photo')->getClientOriginalExtension(); // getting image extension
            $fileName = $request->get('id_number').'.'.$extension; // renaming image
            $request->file('photo')->move($destinationPath, $fileName); // uploading file to given path
        }

        Employee::create([
                'name' => $request->get('name'),
                'surname' => $request->get('surname'),
                'photo' =>  $fileName,
                'email' =>  ($request->has('email')) ? $request->get('email') : null,
                'id_number' => $request->get('id_number'),
                'salary' => ($request->has('salary')) ? $request->get('salary') : null
            ]);

        return Redirect::back()->with('msg', 'The Message');
    }
}
