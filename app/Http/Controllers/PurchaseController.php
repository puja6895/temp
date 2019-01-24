<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\InventoryLog;
use App\Product;
use App\Purchase;
use App\PurchaseAmount;
use App\PurchaseProduct;
use App\Purchaser;
use App\Unit;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use View;

class PurchaseController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$purchases = Purchase::orderBy('purchase_date', 'desc')->get();

		return View::make('app.pos.purchase.list')->with('purchases', $purchases);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//List Of Purchasers
		$purchasers = Purchaser::where('purchaser_status', 1)->orderBy('purchaser_name')->get();

		$products = Product::where('product_status', 1)->get();

		$units = Unit::where('status', 1)->get();

		return View::make('app.pos.purchase.add')->with(['purchasers' => $purchasers, 'products' => $products, 'units' => $units]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$this->validate($request, [
			'purchaser_id' => 'required|exists:purchasers,purchaser_id',
			'purchase_date' => 'required',
			'due_date' => 'required',
			'order_number' => 'required',
			'product_id' => 'required|array|min:1',
			'unit_id' => 'required|array|min:1',
			'rate' => 'required|array|min:1',
			'quantity' => 'required|array|min:1',
			'gst' => 'required|array|min:1',
			'total' => 'required|array|min:1',
		]);
		// dd($request->all());
		try {
			$product_id = $request->product_id;
			$unit_id = $request->unit_id;
			$rate = $request->rate;
			$quantity = $request->quantity;
			$gst = $request->gst;
			$product_name = $request->product_name;
			$unit_name = $request->unit_name;

			DB::beginTransaction();

			// Create Purchase
			$purchase = new Purchase;
			$purchase->purchaser_id = $request->purchaser_id;
			$purchase->purchase_date = Carbon::parse($request->purchase_date)->format('Y-m-d');
			$purchase->due_date = Carbon::parse($request->due_date)->format('Y-m-d');
			$purchase->is_gst = 1;
			$purchase->created_by = Auth::user()->id;
			$purchase->save();

			$purchase_id = $purchase->purchase_id;

			// Create Purchase Product
			$subtotal = 0;
			$total_gst_amount = 0;
			$total_amount = 0;
			for ($i = 0; $i < count($product_id); $i++) {
				# Indivisual Products
				$amount = $quantity[$i] * $rate[$i];
				$gst_amount = $amount * ($gst[$i] / 100);

				$p_product = new PurchaseProduct;
				$p_product->purchase_id = $purchase_id;
				$p_product->product_id = $product_id[$i];
				$p_product->unit_id = $unit_id[$i];
				$p_product->quantity = $quantity[$i];
				$p_product->rate = $rate[$i];
				$p_product->gst = $gst[$i];
				$p_product->gst_amount = $gst_amount;
				$p_product->amount = $amount;
				$p_product->save();

				// Update Inventory
				$inventory = Inventory::where('product_id', $product_id[$i])->first();
				if ($inventory) {
					# Update Inventory
					$inventory->stock = $inventory->stock + $quantity[$i];
					$inventory->updated_by = Auth::user()->id;
					$inventory->save();
				} else {
					#Create New Inventory
					$inventory = new Inventory;
					$inventory->product_id = $product_id[$i];
					$inventory->unit_id = $unit_id[$i];
					$inventory->stock = $quantity[$i];
					$inventory->updated_by = Auth::user()->id;
					$inventory->save();
				}

				// Inventory Log

				$inv_log = new InventoryLog;
				$inv_log->product_id = $product_id[$i];
				$inv_log->unit_id = $unit_id[$i];
				$inv_log->credit = $quantity[$i];
				$inv_log->debit = 0;
				$inv_log->type = 1; //1 = Purchase
				$inv_log->created_by = Auth::user()->id;
				$inv_log->comment = "Purchase of " . $product_name[$i] . " of Quantity " . $quantity[$i] . " " . $unit_name[$i] . " At Rate Of " . $rate[$i] . " By " . Auth::user()->name;
				$inv_log->save();

				$subtotal += $amount;
				$total_gst_amount += $gst_amount;
			}

			// Create Purchase AMount
			$p_amount = new PurchaseAmount;
			$p_amount->purchase_id = $purchase_id;
			$p_amount->subtotal = $subtotal;
			$p_amount->gst = $total_gst_amount;
			$p_amount->adjustment = 0;
			$p_amount->others = 0;
			$p_amount->grand_total = ($subtotal + $total_gst_amount);
			$p_amount->save();

			DB::commit();
			return redirect()->route('purchase.show', ['id' => $purchase_id])->with('success', 'Purchase Recorded SuccessFully.');

		} catch (\Exception $e) {
			DB::rollBack();
			return back()->with('error', $e->getMessage())->withInput();
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Purchase  $purchase
	 * @return \Illuminate\Http\Response
	 */
	public function show(Purchase $purchase, $purchase_id) {
		$purchase = Purchase::where('purchase_id', $purchase_id)->first();

		if (!$purchase) {
			# code...
			return back()->with('error', 'Invalid Purchase Not Found.');
		} else {
			#Redirect To View Of Detail Page
			return View::make('app.pos.purchase.detail')->with(['purchase' => $purchase]);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Purchase  $purchase
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Purchase $purchase) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Purchase  $purchase
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Purchase $purchase) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Purchase  $purchase
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Purchase $purchase) {
		//
	}
}
