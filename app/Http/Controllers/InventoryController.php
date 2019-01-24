<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\InventoryLog;
use App\Product;
use App\Unit;
use Auth;
use DB;
use Illuminate\Http\Request;
use View;

class InventoryController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$inventories = Inventory::get();
		return View::make('app.inv.inv_list')->with(['inventories' => $inventories]);
	}

	#inventory Log
	public function inventoryLog() {
		$inv_logs = InventoryLog::orderBy('created_at', 'desc')->get();
		return View::make('app.inv.inv_log')->with(['inv_logs' => $inv_logs]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$products = Product::where('product_status', 1)->get();
		$units = Unit::where('status', 1)->get();

		return View::make('app.inv.inv_add')->with(['products' => $products, 'units' => $units]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$this->validate($request, [
			'product_id' => 'required|exists:products,product_id',
			'unit_id' => 'required|exists:units,unit_id',
			'quantity' => 'required',
		]);

		try {
			DB::beginTransaction();

			$inventory = Inventory::where('product_id', $request->product_id)->first();

			if (!$inventory) {
				#Crate New Product In Inventory

				$inventory = new Inventory;
				$inventory->product_id = $request->product_id;
				$inventory->unit_id = $request->unit_id;
				$inventory->stock = $request->quantity;
				$inventory->updated_by = Auth::user()->id;
				$inventory->save();

				$product_name = Product::where('product_id', $request->product_id)->value('product_name');
				$unit_name = Unit::where('unit_id', $request->unit_id)->value('unit_name');
				#Ineventory Log
				$inv_log = new InventoryLog;
				$inv_log->product_id = $request->product_id;
				$inv_log->unit_id = $request->unit_id;
				$inv_log->credit = $request->quantity;
				$inv_log->debit = 0;
				$inv_log->type = 3; //3 = Inventory
				$inv_log->created_by = Auth::user()->id;
				$inv_log->comment = "Inventory Add of " . $product_name . " of Quantity " . $request->quantity . " " . $unit_name . " Added By " . Auth::user()->name;
				$inv_log->save();

				DB::commit();
				// Return To Listing Page
				return redirect()->route('inventory')->with('success', 'Inventory Created SuccessFully.');

			} else {

				DB::rollBack();
				return back()->with('error', 'Product Already In Inventory Please Update Quantity')->withInput();

			}

		} catch (\Exception $e) {
			DB::rollBack();
			return back()->with('error', $e->getMessage())->withInput();
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Inventory  $inventory
	 * @return \Illuminate\Http\Response
	 */
	public function show(Inventory $inventory) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Inventory  $inventory
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Inventory $inventory) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Inventory  $inventory
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Inventory $inventory) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Inventory  $inventory
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Inventory $inventory) {
		//
	}
}
