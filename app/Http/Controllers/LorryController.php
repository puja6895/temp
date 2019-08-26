<?php

namespace App\Http\Controllers;

use App\Lorry;
use DB;
use Illuminate\Http\Request;
use View;

class LorryController extends Controller {
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
		//Get All Lorries And Return To View
		$lorries = Lorry::all();

		return View::make('app.lorry.list')->with(['lorries' => $lorries]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {

		//Return To Add Lorry View
		return View::make('app.lorry.add');
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
			'lorry_name' => 'required',
		]);

		try {
			// DB Transection Begin
			DB::beginTransaction();

			// Save Lorry
			$lorry = new Lorry;
			$lorry->lorry_name = $request->lorry_name;
			$lorry->save();

			DB::commit();
			// Return To Listing Page
			return redirect()->route('lorries');

		} catch (\Exception $e) {
			DB::rollBack();
			return back()->with('error', $e->getMessage())->withInput();
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Lorry  $lorry
	 * @return \Illuminate\Http\Response
	 */
	public function show(Lorry $lorry) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Lorry  $lorry
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Lorry $lorry, $lorry_id) {
		//Is Valid
		$is_valid = Lorry::find($lorry_id);

		if ($is_valid) {
			# Valid Then Return TO Edit Page With Data
			return View::make('app.lorry.edit')->with(['lorry' => $is_valid]);
		} else {
			# InVlid Then Return Back With Error
			return back()->with('error', 'Invalid Lorry ID Please Try With Valid ID.');
		}

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Lorry  $lorry
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Lorry $lorry) {

		//Validate
		$this->validate($request, [
			'lorry_id' => 'required|exists:lorries',
			'lorry_name' => 'required',
		]);

		try {
			// DB Transection Begin
			DB::beginTransaction();

			// Update Lorry
			$lorry = Lorry::find($request->lorry_id);
			$lorry->lorry_name = $request->lorry_name;
			$lorry->save();

			DB::commit();
			// Return To Listing Page
			return redirect()->route('lorries');

		} catch (\Exception $e) {
			DB::rollBack();
			return back()->with('error', $e->getMessage())->withInput();
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Lorry  $lorry
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Lorry $lorry) {
		//
	}

	// Lorry Disable And Enable
	public function statusLorry($lorry_id) {
		# Validation
		$is_valid = Lorry::find($lorry_id);

		if ($is_valid) {
			# Change Status And Return Back
			if ($is_valid->lorry_status == 1) {
				# Make Status To 0
				$is_valid->lorry_status = 0;
				$is_valid->save();

				return redirect()->route('lorries')->with('success', 'Lorry Disabled SuccessFully.');

			} else {
				# Make status to 1
				$is_valid->lorry_status = 1;
				$is_valid->save();

				return redirect()->route('lorries')->with('success', 'Lorry Enabled SuccessFully.');
			}

		} else {
			# Return With Invalid Lorry Id Error
			return back()->with('error', 'Invalid Lorry Id Please Try With Correct One');
		}
	}
}
