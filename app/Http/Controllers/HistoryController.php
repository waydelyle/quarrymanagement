<?php namespace App\Http\Controllers;

use App\Oil;
use App\Diesel;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function show()
    {
        return view('history');
    }

    public function diesel(Request $request)
    {
        $fromDate = Carbon::yesterday()->format('Y-m-d');
        if($request->has('fromDate')){
            $fromDate = Carbon::createFromFormat('Y-m-d', $request->get('fromDate'));
        }

        $toDate = Carbon::tomorrow()->format('Y-m-d');
        if($request->has('toDate')){
            $toDate = Carbon::createFromFormat('Y-m-d', $request->get('toDate'))->addDay();
        }

        $dieselData = Diesel::whereBetween('created_at', array($fromDate, $toDate))->get();

        $results = $this->formatData($dieselData);

        return json_encode($results);
    }

    public function oil(Request $request)
    {
        $fromDate = Carbon::today()->subMonth()->format('Y-m-d');
        if($request->has('fromDate')){
            $fromDate = $request->get('fromDate');
        }

        $toDate = Carbon::tomorrow()->format('Y-m-d');
        if($request->has('toDate')){
            $toDate = $request->get('toDate');
        }

        $oilData = Oil::whereBetween('created_at', array($fromDate, $toDate))->get();

        $results = $this->formatData($oilData);

        return json_encode($results);
    }

    private function formatData($modelData)
    {
        $results = [];
        foreach($modelData as $data){
            $results[] = [
                'vehicle' => $data->vehicle->registration,
                'action' => ($data->amount > 0) ? '+' : '-',
                'type' => (isset($data->type)) ? ' - ' . $data->type->label : '',
                'amount' => $data->amount,
                'date' => $data->created_at->format('Y-m-d'),
                'time' => $data->created_at->format('H:m'),
                'auth' => $data->user->name . ' ' . $data->user->surname
            ];
        }

        return $results;
    }

}
