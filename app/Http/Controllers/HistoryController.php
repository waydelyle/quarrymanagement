<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function show()
    {
        return view('history');
    }
}
