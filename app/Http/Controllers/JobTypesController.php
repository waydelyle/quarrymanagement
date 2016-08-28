<?php namespace App\Http\Controllers;

use App\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class JobTypesController extends Controller
{
    public function index()
    {
      $jobTypes = JobType::all();

      return view('job.type.index', ['jobTypes' => $jobTypes]);
    }

    public function show()
    {
      return view('employee.show');
    }

    public function update()
    {
      return view('employee.update');
    }

    public function add(Request $request)
    {
        $label = strtolower(trim($request->get('label')));
        $slug = str_replace(' ', '-', $label);

        JobType::create([
                'slug' => $slug,
                'label' => $label,
            ]);

        return Redirect::back()->with('msg', 'The Message');
    }

    public function store()
    {

    }

    public function delete()
    {

    }
}
