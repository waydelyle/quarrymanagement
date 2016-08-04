<?php namespace App\Http\Controllers;

use App\Diesel;
use App\Http\Requests;
use Illuminate\Http\Request;

class DieselController extends Controller
{

    public function show()
    {
        $diesel = Diesel::all();

        return view('diesel', ['diesel' => $diesel]);
    }

    public function add(Request $request)
    {
        if($request->ajax()){

            $diesel = Diesel::create([
                'vehicle_id' => $request->get('vehicle_id'),
                'amount' => $request->get('amount')
            ]);

            return json_encode($diesel);
        }
    }

    public function subtract(Request $request)
    {
        if($request->ajax()){

            $amount = $request->get('amount');
            if($request->get('amount') > 0){
                $amount = 0 - $request->get('amount');
            }

            $diesel = Diesel::create([
                'vehicle_id' => $request->get('vehicle_id'),
                'amount' => $amount
            ]);

            return json_encode($diesel);
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

}
