<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use DB;
use Illuminate\Http\Request;
use View;

class ProductController extends Controller {
	
	/**
     * Allow Only Authenticated Users
     */

    public function __construct() {
		$this->middleware('auth');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//Get All Products And Return To View
		$products = Product::all();

		return View::make('app.product.list')->with(['products' => $products]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		// Get All Categories
		$categories = Category::all();

		//Return To Add Product View
		return View::make('app.product.add')->with(['categories' => $categories]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//Validate
		$this->validate($request, [
			'product_name' => 'required',
			'category_id' => 'required|exists:categories',
			'gst' => 'required',
		]);

		try {
			// DB Transection Begin
			DB::beginTransaction();

			// Save Product
			$product = new Product;
			$product->product_name = $request->product_name;
			$product->category_id = $request->category_id;
			$product->gst = $request->gst;
			$product->save();

			DB::commit();
			// Return To Listing Page
			return redirect()->route('products');

		} catch (\Exception $e) {
			DB::rollBack();
			return back()->with('error', $e->getMessage())->withInput();
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function show(Product $product) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Product $product, $product_id) {
		//Is Valid
		$is_valid = Product::find($product_id);

		if ($is_valid) {
			// Get All Categories
			$categories = Category::all();
			# Valid Then Return TO Edit Page With Data
			return View::make('app.product.edit')->with(['product' => $is_valid, 'categories' => $categories]);
		} else {
			# InVlid Then Return Back With Error
			return back()->with('error', 'Invalid Product ID Please Try With Valid ID.');
		}

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Product $product) {

		//Validate
		$this->validate($request, [
			'product_id' => 'required|exists:products',
			'product_name' => 'required',
			'gst' => 'required',
			'category_id' => 'required|exists:categories',
		]);

		try {
			// DB Transection Begin
			DB::beginTransaction();

			// Update Product
			$product = Product::find($request->product_id);
			$product->product_name = $request->product_name;
			$product->gst = $request->gst;
			$product->category_id = $request->category_id;
			$product->save();

			DB::commit();
			// Return To Listing Page
			return redirect()->route('products');

		} catch (\Exception $e) {
			DB::rollBack();
			return back()->with('error', $e->getMessage())->withInput();
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Product  $product
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Product $product) {
		//
	}

	// Product Disable And Enable
	public function statusProduct($product_id) {
		# Validation
		$is_valid = Product::find($product_id);

		if ($is_valid) {
			# Change Status And Return Back
			if ($is_valid->product_status == 1) {
				# Make Status To 0
				$is_valid->product_status = 0;
				$is_valid->save();

				return redirect()->route('products')->with('success', 'Product Disabled SuccessFully.');

			} else {
				# Make status to 1
				$is_valid->product_status = 1;
				$is_valid->save();

				return redirect()->route('products')->with('success', 'Product Enabled SuccessFully.');
			}

		} else {
			# Return With Invalid Product Id Error
			return back()->with('error', 'Invalid Product Id Please Try With Correct One');
		}
	}
}
