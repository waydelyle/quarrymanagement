<?php namespace App\Http\Controllers;

use App\Oil;
use App\Http\Requests;
use Illuminate\Http\Request;

class OilController extends Controller
{

    public function show()
    {
        $oil = Oil::all();

        return view('oil', ['oil' => $oil]);
    }

    public function add(Request $request)
    {
        if($request->ajax()){

            $oil = Oil::create([
                'vehicle_id' => $request->get('vehicle_id'),
                'amount' => $request->get('amount')
            ]);

            return json_encode($oil);
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
                'amount' => $amount
            ]);

            return json_encode($oil);
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
