<?php namespace App\Http\Controllers;

use App\Job;
use App\Stock;
use App\Employee;
use App\StockItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StockController extends Controller
{
    public function index()
    {
        $stock = Stock::all();
        $employees = Employee::all();
        $stockItems = StockItem::all();
        $jobs = Job::all();

        if(Employee::count() <= 0){
            return redirect('/employees')->with('error', 'You need to add employees to the system before you can record stock usage. You have been redirected to the page where you can add new employees.');
        }

        if(StockItem::count() <= 0){
            return redirect('/stock-items')->with('error', 'You need to add stock items to the system before you can record stock usage. You have been redirected to the page where you can add new stock items.');
        }

        if(Job::count() <= 0){
            return redirect('/jobs')->with('error', 'You need to add jobs to the system before you can record stock usage. You have been redirected to the page where you can add new jobs.');
        }

        return view('stock.index', ['stock' => $stock, 'employees' => $employees, 'stockItems' => $stockItems, 'jobs' => $jobs]);
    }

    public function add(Request $request)
    {
        Stock::create([
            'employee_id' => $request->get('employee_id'),
            'stock_item_id' => $request->get('stock_item_id'),
            'amount' => $request->get('amount'),
            'job_id' => $request->get('job_id'),
            'description' => $request->get('description')
        ]);

        $stockItem = StockItem::find($request->get('stock_item_id'));
        if( ! empty($stockItem) && $stockItem->count >= $request->get('amount')){
            $stockItem->count = $stockItem->count - $request->get('amount');
            $stockItem->update();
        }

        return Redirect::back()->with('msg', 'The Message');
    }
}
