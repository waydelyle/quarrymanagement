<?php namespace App\Http\Controllers;

use App\Job;
use App\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class JobsController extends Controller
{
    public function index()
    {
      $jobs = Job::all();
      $jobTypes = JobType::all();

      if(JobType::count() <= 0){
          return redirect('/job-types')->with('error', 'You need to add at least one job type before you can add jobs. You have been redirected to the page where you can add job types.');
      }

      return view('job.index', ['jobs' => $jobs, 'jobTypes' => $jobTypes]);
    }

    public function add(Request $request)
    {
        $label = strtolower(trim($request->get('label')));
        $slug = str_replace(' ', '-', $label);

        Job::create([
                'slug' => $slug,
                'label' => $label,
                'job_type_id' => $request->get('job_type_id'),
                'description' => $request->get('description')
            ]);

        return Redirect::back()->with('msg', 'The Message');
    }
}
