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
        $diesel = Diesel::take(100)->get();
        $vehicles = Vehicle::where('id', '!=', Vehicle::NO_VEHICLE)->get();
        $meter = Diesel::whereNotNull('meter')->orderBy('id', 'desc')->first();

        $stock = $this->calculate();

        return view('diesel', ['diesel' => $diesel, 'vehicles' => $vehicles, 'meter' => $meter, 'stock' => $stock]);
    }

    public function add(Request $request)
    {
        if($request->ajax()){

            $meter = Diesel::whereNotNull('meter')->orderBy('id', 'desc')->first();

            if( ! empty($meter)){
                $diesel = Diesel::create([
                    'vehicle_id' => Vehicle::NO_VEHICLE,
                    'user_id' => Auth::user()->id,
                    'amount' => $request->get('amount'),
                    'meter' => $meter->meter
                ]);

                $response = [
                    'vehicle' => ($diesel->vehicle->id != Vehicle::NO_VEHICLE) ? $diesel->vehicle->registration : '',
                    'amount' => $diesel->amount,
                    'action' => '+',
                    'meter' => $diesel->meter,
                    'date' => $diesel->created_at->format('Y-m-d'),
                    'time' => $diesel->created_at->format('H:m'),
                    'auth' => $diesel->user->name . ' ' . $diesel->user->surname
                ];

                return json_encode($response);
            }

        }
    }

    public function subtract(Request $request)
    {
        if($request->ajax()){

            $meter = Diesel::whereNotNull('meter')->orderBy('id', 'desc')->first();

            if(empty($meter) || $meter->meter <  $request->get('meter')){
                $amount = $meter->meter - $request->get('meter');

                $diesel = Diesel::create([
                    'vehicle_id' => $request->get('vehicle_id'),
                    'user_id' => Auth::user()->id,
                    'amount' =>  $amount,
                    'meter' => $request->get('meter')
                ]);

                $response = [
                    'vehicle' => ($diesel->vehicle->id != Vehicle::NO_VEHICLE) ? $diesel->vehicle->registration : '',
                    'amount' => $diesel->amount,
                    'action' => '-',
                    'meter' => $diesel->meter,
                    'date' => $diesel->created_at->format('Y-m-d'),
                    'time' => $diesel->created_at->format('H:m'),
                    'auth' => $diesel->user->name . ' ' . $diesel->user->surname
                ];

                return json_encode($response);
            }
        }
    }

    public function delete(Request $request)
    {
        $diesel = Diesel::find($request->get('id'));

        if( ! empty($diesel) ){
            $diesel->delete();

            return json_encode([
                'message' => 'Vehicle successfully deleted.',
                'type' => 'success'
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
