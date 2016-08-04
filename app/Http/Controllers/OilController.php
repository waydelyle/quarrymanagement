<?php namespace App\Http\Controllers;

use App\Oil;
use App\OilType;
use App\Vehicle;
use App\Http\Requests;
use Illuminate\Http\Request;

class OilController extends Controller
{

    public function show()
    {
        $oil = Oil::take(100)->get();
        $oilTypes = OilType::all();
        $vehicles = Vehicle::where('id', '!=', Vehicle::NO_VEHICLE)->get();

        return view('oil', ['oil' => $oil, 'oilTypes' => $oilTypes, 'vehicles' => $vehicles]);
    }

    public function add(Request $request)
    {
        if($request->ajax()){

            $oil = Oil::create([
                'vehicle_id' => Vehicle::NO_VEHICLE,
                'oil_type_id' => $request->get('oil_type_id'),
                'amount' => $request->get('amount')
            ]);

            $response = [
                'vehicle' => ($oil->vehicle->id != Vehicle::NO_VEHICLE) ? $oil->vehicle->registration : '',
                'amount' => $oil->amount,
                'action' => '+',
                'type' => $oil->type->label,
                'date' => $oil->created_at->format('Y-m-d'),
                'time' => $oil->created_at->format('H:m'),
                'auth' => $oil->user_id
            ];

            return json_encode($response);
        }
    }

    public function subtract(Request $request)
    {
        if($request->ajax()){

            $amount = $request->get('amount');
            if($request->get('amount') > 0){
                $amount = 0 - $request->get('amount');
            }

            $oil = Oil::create([
                'vehicle_id' => $request->get('vehicle_id'),
                'oil_type_id' => $request->get('oil_type_id'),
                'amount' => $amount
            ]);

            $response = [
                'vehicle' => $oil->vehicle->registration,
                'amount' => $oil->amount,
                'action' => '-',
                'type' => $oil->type->label,
                'date' => $oil->created_at->format('Y-m-d'),
                'time' => $oil->created_at->format('H:m'),
                'auth' => $oil->user_id
            ];

            return json_encode($response);
        }
    }

    public function delete(Request $request)
    {
        $oil = Oil::find($request->get('id'));

        if( ! empty($oil) ){
            $oil->delete();

            return json_encode([
                'message' => 'Vehicle successfully deleted.',
                'type' => 'success'
            ]);
        }
    }

}
