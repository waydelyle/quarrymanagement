<?php namespace App\Http\Controllers;

use Auth;
use App\Oil;
use App\OilType;
use App\Vehicle;
use App\Http\Requests;
use Illuminate\Http\Request;

class OilController extends Controller
{

    public function show()
    {
        $oil = Oil::orderBy('created_at', 'desc')->take(100)->get();
        $oilTypes = OilType::all();
        $vehicles = Vehicle::where('id', '!=', Vehicle::NO_VEHICLE)->get();
        $calculatedOil = $this->calculate();

        return view('oil', ['oil' => $oil, 'oilTypes' => $oilTypes, 'vehicles' => $vehicles, 'calculatedOil' => $calculatedOil]);
    }

    public function update( $id , Request $request)
    {
        if( empty($id) ){
            return redirect('/oil');
        }

        $oil = Oil::find($id);
        $oilTypes = OilType::all();
        $vehicles = Vehicle::where('id', '!=', Vehicle::NO_VEHICLE)->get();

        if(empty($oil)){
            return redirect('/oil');
        }

        if($request->has('amount')){
            $oil->amount = $request->get('amount');

            if($request->has('vehicle_id'))
            {
                $oil->vehicle_id = $request->get('vehicle_id');
            }

            $oil->oil_type_id = $request->get('oil_type_id');
            $oil->update();
            return redirect('/oil');
        }

        return view('oil.update', ['oil' => $oil, 'oilTypes' => $oilTypes, 'vehicles' => $vehicles]);
    }

    public function add(Request $request)
    {
        if($request->ajax()){

            $oil = Oil::create([
                'vehicle_id' => Vehicle::NO_VEHICLE,
                'user_id' => Auth::user()->id,
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
                'auth' => $oil->user->name . ' ' . $oil->user->surname
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
                'user_id' => Auth::user()->id,
                'amount' => $amount
            ]);

            $response = [
                'vehicle' => $oil->vehicle->registration,
                'amount' => $oil->amount,
                'action' => '-',
                'type' => $oil->type->label,
                'date' => $oil->created_at->format('Y-m-d'),
                'time' => $oil->created_at->format('H:m'),
                'auth' => $oil->user->name . ' ' . $oil->user->surname
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

    private function calculate()
    {
        $oil = Oil::all();
        $oilTypes = OilType::all();

        $totalOil = [];
        $totalOilTypes = [];

        foreach ($oilTypes as $type){
            $totalOil[$type->label] = 0;
        }

        if( ! empty($oil) ){
            foreach($oil as $row){
                $totalOil[$row->type->label] = $totalOil[$row->type->label] + $row->amount;
            }
        }

        return $totalOil;
    }
}
