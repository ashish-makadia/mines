<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AssetsStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AssetsStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if($request->ajax()) {
            $stockItems = AssetsStock::with('workingAssets')
    ->select(
        'item_name',
        'working_assets',
        DB::raw('SUM(CASE WHEN type = "purchase" THEN quantity ELSE 0 END) as total_purchase_quantity'),
        DB::raw('SUM(CASE WHEN type = "sale" THEN quantity ELSE 0 END) as total_sale_quantity'),
        DB::raw('SUM(CASE WHEN type = "purchase" THEN quantity WHEN type = "sale" THEN -quantity ELSE 0 END) as remaining_quantity')
    )
    ->groupBy('item_name', 'working_assets');
            return DataTables::of($stockItems) ->addIndexColumn()->make(true);
        }
        return view('admin.assets-stock.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
