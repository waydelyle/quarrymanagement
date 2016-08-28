<?php namespace App\Http\Controllers;

use App\StockItem;
use App\StockType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StockItemsController extends Controller
{
    public function index()
    {
        $stockItems = StockItem::all();
        $stockTypes = StockType::all();

        if(StockType::count() <= 0){
            return redirect('/stock-types')->with('error', 'You need to create at least one stock type before you can add stock items. You have been redirected to the page where you can add stock types.');
        }

        return view('stock.items.index', ['stockItems' => $stockItems, 'stockTypes' => $stockTypes]);
    }

    public function add(Request $request)
    {
        $label = strtolower(trim($request->get('label')));
        $slug = str_replace(' ', '-', $label);

        StockItem::create([
            'slug' => $slug,
            'label' => $label,
            'description' => $request->get('description'),
            'stock_type_id' => $request->get('stock_type_id'),
            'count' => $request->get('amount'),
        ]);

        return Redirect::back()->with('msg', 'The Message');
    }

    public function addStock($id, Request $request)
    {
        StockItem::create([
            'user_id' => Auth::user()->id,
            'stock_item_id' => $id
        ]);

        return Redirect::back()->with('msg', 'The Message');
    }

    public function update($id, Request $request)
    {
        $stockItem = StockItem::find($id);
        $stockTypes = StockType::all();

        if($request->has('count')){

            if($request->has('label')){
                $stockItem->label = $request->get('label');
            }

            if($request->has('description')) {
                $stockItem->description = $request->get('description');
            }

            if($request->has('stock_type_id')) {
                $stockItem->stock_type_id = $request->get('stock_type_id');
            }

            $stockItem->update();

            return redirect('/stock-items');
        }

        return view('stock.items.update', ['stockItem' => $stockItem, 'stockTypes' => $stockTypes]);

    }

    public function delete($id, Request $request)
    {
        $stockItem = StockItem::find($id);
        $stockItem->delete();
        return redirect('/stock-items');
    }


}
