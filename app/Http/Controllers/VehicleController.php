<?php namespace App\Http\Controllers;

use Auth;
use App\Vehicle;
use App\Http\Requests;
use Illuminate\Http\Request;

class VehicleController extends Controller
{

    public function show()
    {
        $vehicles = Vehicle::where('id', '!=', Vehicle::NO_VEHICLE)->get();

        return view('vehicles', ['vehicles' => $vehicles]);
    }

    public function add(Request $request)
    {
        if($request->ajax()){

            $vehicle = Vehicle::create([
                'registration' => $request->get('registration'),
                'user_id' => Auth::user()->id,
            ]);

            return json_encode($vehicle);
        }
    }

    public function delete(Request $request)
    {
        if($request->ajax()) {
            $vehicle = Vehicle::find($request->get('id'));

            if( ! empty($vehicle) ){
                $vehicle->delete();
            }
        }
    }
}
