<?php namespace App\Http\Controllers;

use Auth;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class VehicleController extends Controller
{

    public function show()
    {
        $vehicles = Vehicle::where('id', '!=', Vehicle::NO_VEHICLE)->get();

        return view('vehicles', ['vehicles' => $vehicles]);
    }

    public function update( $id , Request $request)
    {
        if( empty($id) ){
            return redirect('/vehicles');
        }

        $vehicle = Vehicle::find($id);

        if(empty($vehicle)){
            return redirect('/vehicles');
        }

        if($request->has('registration')){
            $vehicle->registration = $request->get('registration');
            $vehicle->update();
            return redirect('/vehicles');
        }

        return view('vehicle.update', ['vehicle' => $vehicle]);
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
