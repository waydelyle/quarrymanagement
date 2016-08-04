<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function show()
    {
        return view('welcome');
    }
}
