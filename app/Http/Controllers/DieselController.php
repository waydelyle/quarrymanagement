<?php namespace App\Http\Controllers;

use Auth;
use App\Diesel;
use App\Http\Requests;
use App\Vehicle;
use Illuminate\Http\Request;

class DieselController extends Controller
{

    public function show()
    {
        $diesel = Diesel::orderBy('created_at', 'desc')->take(100)->get();
        $vehicles = Vehicle::where('id', '!=', Vehicle::NO_VEHICLE)->get();
        $meter = Diesel::whereNotNull('meter')->orderBy('id', 'desc')->first();

        $stock = $this->calculate();

        return view('diesel', ['diesel' => $diesel, 'vehicles' => $vehicles, 'meter' => $meter, 'stock' => $stock]);
    }

    public function update( $id , Request $request)
    {
        if( empty($id) ){
            return redirect('/oil');
        }

        $diesel = Diesel::find($id);
        $vehicles = Vehicle::where('id', '!=', Vehicle::NO_VEHICLE)->get();

        if(empty($diesel)){
            return redirect('/diesel');
        }

        if($request->has('amount') || $request->has('meter') ){

            if($request->has('vehicle_id')){
                $diesel->vehicle_id = $request->get('vehicle_id');
            }

            if($request->has('meter')) {
                $diesel->meter = $request->get('meter');
            }

            if($request->has('amount')) {
                $diesel->amount = $request->get('amount');
            }

            $diesel->update();
            return redirect('/diesel');
        }

        return view('diesel.update', ['diesel' => $diesel, 'vehicles' => $vehicles]);
    }

    public function add(Request $request)
    {
        if($request->ajax()){

            if($request->get('amount') <= 0 ){
                return json_encode(['code' => '', 'message' => 'You have not entered any valid amount of diesel.']);
            }

            $meter = Diesel::whereNotNull('meter')->orderBy('id', 'desc')->first();

            if( ! empty($meter)){
                $diesel = Diesel::create([
                    'vehicle_id' => Vehicle::NO_VEHICLE,
                    'user_id' => Auth::user()->id,
                    'amount' => $request->get('amount'),
                    'meter' => $meter->meter
                ]);

                $response = [
                    'id' => $diesel->id,
                    'vehicle' => ($diesel->vehicle->id != Vehicle::NO_VEHICLE) ? $diesel->vehicle->registration : '',
                    'amount' => $diesel->amount,
                    'action' => '+',
                    'meter' => $diesel->meter,
                    'date' => $diesel->created_at->format('Y-m-d'),
                    'time' => $diesel->created_at->format('H:m'),
                    'auth' => $diesel->user->name . ' ' . $diesel->user->surname,
                    'message' => 'You added ' . $diesel->amount . ' diesel. The current meter number is ' . $diesel->meter . '.'
                ];

                return json_encode($response);
            } else {
                return json_encode(['code' => '', 'message' => 'You first need to click subtract to register the current meter reading.']);
            }

        }
    }

    public function subtract(Request $request)
    {
        if($request->ajax()){

            $meter = Diesel::whereNotNull('meter')->orderBy('id', 'desc')->first();

            if(empty($meter) || $meter->meter <  $request->get('meter')){

                if(empty($meter)){
                    $amount = 0;
                } else {
                    $amount = $meter->meter - $request->get('meter');
                }

                $diesel = Diesel::create([
                    'vehicle_id' => $request->get('vehicle_id'),
                    'user_id' => Auth::user()->id,
                    'amount' =>  $amount,
                    'meter' => $request->get('meter')
                ]);

                $response = [
                    'id' => $diesel->id,
                    'vehicle' => ($diesel->vehicle->id != Vehicle::NO_VEHICLE) ? $diesel->vehicle->registration : '',
                    'amount' => $diesel->amount,
                    'action' => '-',
                    'meter' => $diesel->meter,
                    'date' => $diesel->created_at->format('Y-m-d'),
                    'time' => $diesel->created_at->format('H:m'),
                    'auth' => $diesel->user->name . ' ' . $diesel->user->surname,
                    'message' => 'You subtracted ' . $diesel->amount . ' diesel for ' . $diesel->vehicle->registration . '. The current meter number is ' . $diesel->meter . '.'
                ];

                return json_encode($response);
            } else {
                return json_encode([
                    'code' => '',
                    'message' => 'The meter number you entered was ' . $request->get('meter')
                        . ' the last entered meter number was ' . $meter->meter . '. Please enter a new meter number.'
                ]);
            }
        }
    }

    public function delete(Request $request)
    {
        $diesel = Diesel::find($request->get('id'));

        if( ! empty($diesel) ){
            $diesel->delete();

            return json_encode([
                'message' => 'This diesel reading was deleted.'
            ]);
        }
    }

    private function calculateMeter()
    {
        $diesel = Diesel::all();

        $totalDieselMeter = [];
        $lastMeterAmount = 0;
        foreach($diesel as $row){

            if($lastMeterAmount == 0){
                $lastMeterAmount = $row->meter;
            }

            if($lastMeterAmount != $row->meter){
                $totalDieselMeter[] = $lastMeterAmount - $row->meter;
            }

        }

        return array_sum($totalDieselMeter);
    }

    private function calculate()
    {
        $diesel = Diesel::all();

        $totalDieselAdded = [];
        foreach($diesel as $row){
            $totalDieselAdded[] = $row->amount;
        }

        return array_sum($totalDieselAdded);
    }

    private function calculateStock()
    {
        $subtracted = $this->calculateMeter();
        $added = $this->calculateDiesel();

        $stock = $added - $subtracted;

        return $this->calculateDiesel();
    }
}
