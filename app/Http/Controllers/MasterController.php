<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use View;
use DB;

class MasterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Get All Units Master
    public function getUnits()
    {
    	$units = Unit::all();
    	return View::make('app.master.unit.list')->with('units',$units);
    }

    //Add Unit View
    public function addUnit()
    {
    	return View::make('app.master.unit.add');
    }

    // Store Unit In DB
    public function storeUnit(Request $request)
    {
    	# Validation
    	$this->validate($request, [
                    'unit_name' 	=> 'required|unique:units',
                ]);

    	try{
    		// DB Transection Begin
            DB::beginTransaction();

            // Save New Unit In DB
            $unit = new Unit;
            $unit->unit_name = $request->unit_name;
            $save_unit = $unit->save();

            // Check If Data Saved
            if ($save_unit) {
            	# DB Commit And Return Success
            	DB::commit();
	            return redirect()->route('master.units')->with('success','New Unit Added  SuccessFully.');
            } else {
            	# DB Roll Back And Return Error Message
            	DB::rollBack();
	            return back()->with('error','Fail To Store New Unit, Please Try Again.')->withInput();
            }
            
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('error_msg',$e->getMessage())->withInput();
        }
    }
}
