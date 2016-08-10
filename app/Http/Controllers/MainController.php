<?php namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function show()
    {
        return view('welcome');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
