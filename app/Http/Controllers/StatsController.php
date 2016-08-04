<?php namespace App\Http\Controllers;

use App\Oil;
use App\Diesel;
use App\Vehicle;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function show()
    {
        return view('stats');
    }

    public function diesel()
    {
        $data = $this->getData('diesel', 7);

        return json_encode($data);
    }

    public function oil()
    {
        $data = $this->getData('oil', 7);

        return json_encode($data);
    }

    private function getData($chart, $daysToSubtract = 7)
    {
        // build the transaction dates and amounts
        $dayMinusDays = 0;

        $dates = [];
        $chartData = [];

        while($dayMinusDays < $daysToSubtract)
        {
            $date = Carbon::today()->subDay($dayMinusDays)->format('Y-m-d');
            $dates[] = $date;
            $chartData[$dayMinusDays] = [$date, 0];

            $dayMinusDays++;
        }

        switch($chart)
        {
            case 'diesel':
            $rows = Diesel::where('created_at', '>=', Carbon::today()->subDay($daysToSubtract))->get();
                break;
            case 'oil':
            $rows = Oil::where('created_at', '>=', Carbon::today()->subDay($daysToSubtract))->get();
                break;
            default:
                $rows = null;
                break;
        }

        $chartData = $this->formatData( $rows , $chartData , $dates);


        array_unshift($chartData, ['date', $chart]);

        return $chartData;
    }

    private function formatData( $rows , $chartData , $dates)
    {

        if( ! empty($rows) ){
            foreach($rows as $row){
                // find the position of this date in $transaction dates to add to the date total
                $datePosition = array_search($row->created_at->format('Y-m-d'), $dates);

                if($datePosition !== false){
                    $chartData[$datePosition][1] = $chartData[$datePosition][1] + (float) $row->amount;
                }
            }
        }

        return $chartData;
    }
}
