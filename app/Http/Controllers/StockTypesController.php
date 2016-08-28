<?php namespace App\Http\Controllers;

use App\StockType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StockTypesController extends Controller
{
    public function index()
    {
        $stockTypes = StockType::all();

        return view('stock.type.index', ['stockTypes' => $stockTypes]);
    }

    public function add(Request $request)
    {
        $label = strtolower(trim($request->get('label')));
        $slug = str_replace(' ', '-', $label);

        StockType::create([
            'slug' => $slug,
            'label' => $label,
            'description' => $request->get('description'),
        ]);

        return Redirect::back()->with('msg', 'The Message');
    }

}
