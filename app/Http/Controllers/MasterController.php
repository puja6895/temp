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

    // Edit Unit
    public function editUnit($unit_id)
    {
    	# Validation
    	$is_valid = Unit::find($unit_id);

    	if ($is_valid) {
    		# Return On Edit Page With Unit Detail
    		return View::make('app.master.unit.edit')->with('unit',$is_valid);
    	} else {
    		# Return With Invalid Unit Id Error
    		return back()->with('error','Invalid Unit Id Please Try With Correct One');
    	}
    	
    }

    // Update Unit
    public function updateUnit(Request $request)
    {
    	# Validation
    	$this->validate($request, [
                    'unit_id' 	=> 'required|exists:units',
                    'unit_name' 	=> 'required|unique:units',
                ]);

    	try{
    		// DB Transection Begin
            DB::beginTransaction();

            // Save New Unit In DB
            $unit =  Unit::find($request->unit_id);
            $unit->unit_name = $request->unit_name;
            $save_unit = $unit->save();

            // Check If Data Saved
            if ($save_unit) {
            	# DB Commit And Return Success
            	DB::commit();
	            return redirect()->route('master.units')->with('success','Unit Updated  SuccessFully.');
            } else {
            	# DB Roll Back And Return Error Message
            	DB::rollBack();
	            return back()->with('error','Fail To Update Unit, Please Try Again.')->withInput();
            }
            
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('error_msg',$e->getMessage())->withInput();
        }
    }

    // Change Status Of Unit
    public function statusUnit($unit_id)
    {
    	# Validation
    	$is_valid = Unit::find($unit_id);

    	if ($is_valid) {
    		# Change Status And Return Back
    		if ($is_valid->status == 1) {
    			# Make Status To 0
    			$is_valid->status = 0;
    			$is_valid->save();

    			return redirect()->route('master.units')->with('success','Unit Disabled SuccessFully.');
    			
    		} else {
    			# Make status to 1
    			$is_valid->status = 1;
    			$is_valid->save();

    			return redirect()->route('master.units')->with('success','Unit Enabled SuccessFully.');
    		}

    	} else {
    		# Return With Invalid Unit Id Error
    		return back()->with('error','Invalid Unit Id Please Try With Correct One');
    	}
    }
}
