<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Inventory;
use App\InventoryLog;
use App\Product;
use App\Sell;
use App\SellAmount;
use App\SellProduct;
use App\Unit;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use View;

class SellController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$sells = Sell::orderBy('sell_date', 'desc')->get();

		return View::make('app.pos.sell.list')->with('sells', $sells);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$customers = Customer::where('customer_status', 1)->orderBy('customer_name')->get();

		$products = Product::where('product_status', 1)->get();

		$units = Unit::where('status', 1)->get();

		return View::make('app.pos.sell.add')->with(['customers' => $customers, 'products' => $products, 'units' => $units]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		// dd($request->all());
		$this->validate($request, [
			'customer_id' => 'required|exists:customers,customer_id',
			'sell_date' => 'required',
			'product_id' => 'required|array|min:1',
			'unit_id' => 'required|array|min:1',
			'rate' => 'required|array|min:1',
			'quantity' => 'required|array|min:1',
			'gst' => 'required|array|min:1',
			'total' => 'required|array|min:1',
		]);
		try {
			$product_id = $request->product_id;
			$unit_id = $request->unit_id;
			$rate = $request->rate;
			$quantity = $request->quantity;
			$gst = $request->gst;
			$product_name = $request->product_name;
			$unit_name = $request->unit_name;

			DB::beginTransaction();

			// Create SEll
			$sell = new Sell;
			$sell->customer_id = $request->customer_id;
			$sell->sell_date = Carbon::parse($request->sell_date)->format('Y-m-d');
			$sell->is_gst = 1;
			$sell->created_by = Auth::user()->id;
			$sell->save();

			$sell_id = $sell->sell_id;

			// Create Sell Product
			$subtotal = 0;
			$total_gst_amount = 0;
			$total_amount = 0;
			for ($i = 0; $i < count($product_id); $i++) {
				# Indivisual Products
				$amount = $quantity[$i] * $rate[$i];
				$gst_amount = $amount * ($gst[$i] / 100);

				$s_product = new SellProduct;
				$s_product->sell_id = $sell_id;
				$s_product->product_id = $product_id[$i];
				$s_product->unit_id = $unit_id[$i];
				$s_product->quantity = $quantity[$i];
				$s_product->rate = $rate[$i];
				$s_product->gst = $gst[$i];
				$s_product->gst_amount = $gst_amount;
				$s_product->amount = $amount;
				$s_product->save();

				// Update Inventory
				$inventory = Inventory::where('product_id', $product_id[$i])->first();
				if ($inventory && ($inventory->stock >= $quantity[$i])) {
					# Update Inventory
					$inventory->stock = $inventory->stock - $quantity[$i];
					$inventory->updated_by = Auth::user()->id;
					$inventory->save();
				} else {
					#Out Of Stock
					DB::rollBack();
					return back()->with('error', $product_name[$i] . " This Product is Out Of Stock.")->withInput();
				}

				// Inventory Log

				$inv_log = new InventoryLog;
				$inv_log->product_id = $product_id[$i];
				$inv_log->unit_id = $unit_id[$i];
				$inv_log->credit = 0;
				$inv_log->debit = $quantity[$i];
				$inv_log->type = 2; //2 = Sell
				$inv_log->created_by = Auth::user()->id;
				$inv_log->comment = "Sell of " . $product_name[$i] . " of Quantity " . $quantity[$i] . " " . $unit_name[$i] . " At Rate Of " . $rate[$i] . " By " . Auth::user()->name;
				$inv_log->save();

				$subtotal += $amount;
				$total_gst_amount += $gst_amount;
			}

			// Create Sell AMount
			$s_amount = new SellAmount;
			$s_amount->sell_id = $sell_id;
			$s_amount->subtotal = $subtotal;
			$s_amount->gst = $total_gst_amount;
			$s_amount->adjustment = 0;
			$s_amount->others = 0;
			$s_amount->grand_total = ($subtotal + $total_gst_amount);
			$s_amount->save();

			DB::commit();
			return redirect()->route('sell.show', ['id' => $sell_id])->with('success', 'Sell Recorded SuccessFully.');

		} catch (\Exception $e) {
			DB::rollBack();
			return back()->with('error', $e->getMessage())->withInput();
		}

	}
	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Sell  $sell
	 * @return \Illuminate\Http\Response
	 */
	public function show(Sell $sell, $sell_id) {
		$sell = Sell::where('sell_id', $sell_id)->first();

		if (!$sell) {
			# code...
			return back()->with('error', 'Invalid Sell ! Not Found.');
		} else {
			#Redirect To View Of Detail Page
			return View::make('app.pos.sell.detail')->with(['sell' => $sell]);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Sell  $sell
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Sell $sell) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Sell  $sell
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Sell $sell) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Sell  $sell
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Sell $sell) {
		//
	}
}
