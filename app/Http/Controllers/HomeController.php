<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Inventory;
use App\Lorry;
use App\Product;
use App\Purchase;
use App\PurchaseAmount;
use App\Purchaser;
use App\Sell;
use App\SellAmount;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$customers = Customer::count();
		$purchasers = Purchaser::count();
		$sells = Sell::all();
		$purchases = Purchase::all();
		$inventories = Inventory::all();
		$lorries = Lorry::all();
		$sell_due = SellAmount::sum('grand_total');
		$purchase_due = PurchaseAmount::sum('grand_total');
		$products = Product::all();

		return view('app.dashboard')->with([
			"customers" => $customers,
			"purchasers" => $purchasers,
			"sells" => $sells,
			"purchases" => $purchases,
			"inventories" => $inventories,
			"products" => $products,
			"purchase_due" => $purchase_due,
			"sell_due" => $sell_due,
			"lorries" => $lorries,
		]);
	}
}
