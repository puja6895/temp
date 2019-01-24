<?php

namespace App\Http\Controllers;
use App\DefaultProductSell;
use App\Inventory;
use App\Product;
use App\Unit;
use DB;
use Illuminate\Http\Request;
use View;

class DefaultController extends Controller {
//===============================Default Product Sell Start=========================//
	//Get Product Defaults
	public function defaultProductSell() {
		$product_sell_defaults = DefaultProductSell::all();

		return View::make('app.defaults.productsell.list')->with(['product_sell_defaults' => $product_sell_defaults]);
	}

	// Add view Page
	public function addViewDefaultProductSell() {
		# Return With Product And Unit
		$products = Product::where('product_status', 1)->get();
		$units = Unit::where('status', 1)->get();

		return View::make('app.defaults.productsell.add')->with(['products' => $products, 'units' => $units]);
	}

	// Add Default Product
	public function addDefaultProductSell(Request $request) {
		//Validate
		$this->validate($request, [
			'product_id' => 'required|exists:products,product_id',
			'unit_id' => 'required|exists:units,unit_id',
			'purchase_price' => 'required',
			'sell_price' => 'required',
		]);

		try {
			$is_present = DefaultProductSell::where('product_id', $request->product_id)->where('unit_id', $request->unit_id)->count();

			if ($is_present > 0) {
				return back()->with('error', 'Product Default For this Unit Already Set, You Can Edit That.')->withInput();
			}
			// DB Transection Begin
			DB::beginTransaction();

			// Save Default Product Sell
			$default_product_sell = new DefaultProductSell;
			$default_product_sell->product_id = $request->product_id;
			$default_product_sell->unit_id = $request->unit_id;
			$default_product_sell->purchase_price = $request->purchase_price;
			$default_product_sell->sell_price = $request->sell_price;
			$default_product_sell->save();

			DB::commit();
			// Return To Listing Page
			return redirect()->route('default.product.sell')->with('success', 'Default Product Sell SuccessFully Set.');

		} catch (\Exception $e) {
			DB::rollBack();
			return back()->with('error', $e->getMessage())->withInput();
		}
	}

	// Edit Default Product Sell
	public function editDefaultProductSell($default_product_sell_id) {
		$is_valid = DefaultProductSell::find($default_product_sell_id);
		if ($is_valid) {
			$products = Product::where('product_status', 1)->get();
			$units = Unit::where('status', 1)->get();
			# Valid Then Return TO Edit Page With Data
			return View::make('app.defaults.productsell.edit')->with(['default_product_sell' => $is_valid, 'products' => $products, 'units' => $units]);
		} else {
			# InVlid Then Return Back With Error
			return back()->with('error', 'Invalid ID Please Try With Valid ID.');
		}
	}

	// Update Default Product Sell
	public function updateDefaultProductSell(Request $request) {
		//Validate
		$this->validate($request, [
			'default_product_sell_id' => 'required|exists:default_product_sells,default_product_sell_id',
			'sell_price' => 'required',
			'purchase_price' => 'required',
		]);

		try {
			DB::beginTransaction();

			$default_product_sell = DefaultProductSell::where('default_product_sell_id', $request->default_product_sell_id)->first();

			if ($default_product_sell) {
				#update Prce
				$default_product_sell->purchase_price = $request->purchase_price;
				$default_product_sell->sell_price = $request->sell_price;
				$default_product_sell->save();

				DB::commit();
				// Return To Listing Page
				return redirect()->route('default.product.sell')->with('success', 'Default Product Sell SuccessFully Updated.');

			} else {

				DB::rollBack();
				return back()->with('error', 'Invalid Product Sell.')->withInput();

			}

		} catch (\Exception $e) {
			DB::rollBack();
			return back()->with('error', $e->getMessage())->withInput();
		}
	}
//===============================Default Product Sell End=========================//

	#Get Default Price
	public function getDefault($product_id) {
		$default_price = DefaultProductSell::where('product_id', $product_id)->first();
		// dd($product_id);
		$gst = Product::where('product_id', $product_id)->value('gst');

		$available_stock = Inventory::where('product_id', $product_id)->value('stock');

		return response()->json(['unit_name' => $default_price ? $default_price->unit->unit_name : 'Unit', 'unit_id' => $default_price ? $default_price->unit_id : '', 'sell_price' => $default_price ? $default_price->sell_price : 0, 'purchase_price' => $default_price ? $default_price->purchase_price : 0, 'gst' => $gst ? $gst : 0, 'stock' => $available_stock ? $available_stock : 0]);
	}
}
