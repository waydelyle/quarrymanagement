<?php namespace App\Http\Controllers;

use App\Oil;
use App\Diesel;
use App\Vehicle;
use App\Http\Requests;
use Illuminate\Http\Request;

class VehicleController extends Controller
{

    public function show()
    {
        $oil = Oil::all();
        $diesel = Diesel::all();
        $vehicles = Vehicle::all();

        return view('vehicles', ['vehicles' => $vehicles, 'diesel' => $diesel, 'oil' => $oil]);
    }

    public function add(Request $request)
    {
        if($request->ajax()){

            $vehicle = Vehicle::create([
                'registration' => $request->get('registration')
            ]);

            return json_encode($vehicle);

//            if ( $update == 200 ) {
//                return json_encode([
//                    'message' => 'Product successfully updated.',
//                    'flag' => 'success'
//                ]);
//            } else {
//                return json_encode([
//                    'message' => 'Product could not be updated.',
//                    'flag' => 'error'
//                ]);
//            }
        }
    }

    public function delete(Request $request)
    {
        if($request->ajax()) {
            $vehicle = Vehicle::find($request->get('id'));

            if( ! empty($vehicle) ){
                $vehicle->delete();

                return json_encode([
                    'message' => 'Vehicle successfully deleted.',
                    'type' => 'success'
                ]);
            }
//
//            if ( $update == 200 ) {
//                return json_encode([
//                    'message' => 'Product successfully updated.',
//                    'flag' => 'success'
//                ]);
//            } else {
//                return json_encode([
//                    'message' => 'Product could not be updated.',
//                    'flag' => 'error'
//                ]);
//            }
        }
    }
}
