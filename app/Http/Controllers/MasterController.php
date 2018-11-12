<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use App\PaymentMode;
use App\Category;
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
//=============================Units Master Route Start================//
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
            return back()->with('error',$e->getMessage())->withInput();
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
            return back()->with('error',$e->getMessage())->withInput();
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

//=============================Units Master Route End================//


//=============================Payment Mode Master Route Start================//

    #Get Payment Modes
    public function getPaymentModes()
    {
    	# Get ALl Payment Modes
    	$payment_modes = PaymentMode::all();
    	return View::make('app.master.payment-mode.list')->with('payment_modes',$payment_modes);
    }

    #Add Payment Mode
    public function addPaymentMode()
    {
    	# Return To View Page Of Add Payment Mode
    	return View::make('app.master.payment-mode.add');
    }

    #Store Payment Mode
    public function storePaymentMode(Request $request)
    {
    	# Validation
    	$this->validate($request, [
                    'payment_mode' 	=> 'required|unique:payment_modes',
                ]);

    	try{
    		// DB Transection Begin
            DB::beginTransaction();

            // Save New Payment Mode In DB
            $payment_mode = new PaymentMode;
            $payment_mode->payment_mode = $request->payment_mode;
            $save_payment_mode = $payment_mode->save();

            // Check If Data Saved
            if ($save_payment_mode) {
            	# DB Commit And Return Success
            	DB::commit();
	            return redirect()->route('master.payment-mode')->with('success','Payment Mode Added  SuccessFully.');
            } else {
            	# DB Roll Back And Return Error Message
            	DB::rollBack();
	            return back()->with('error','Fail To Store Payment Mode, Please Try Again.')->withInput();
            }
            
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage())->withInput();
        }
    }

    #Edit Payment Mode
    public function editPaymentMode($payment_mode_id='')
    {
    	# Validation
    	$is_valid = PaymentMode::find($payment_mode_id);

    	if ($is_valid) {
    		# Return On Edit Page With Payment Mode Detail
    		return View::make('app.master.payment-mode.edit')->with('payment_mode',$is_valid);
    	} else {
    		# Return With Invalid Payment Mode Id Error
    		return back()->with('error','Invalid Payment Mode Id Please Try With Correct One');
    	}
    }

    #update Payment Mode
    public function updatePaymentMode(Request $request)
    {
    	# Validation
    	$this->validate($request, [
                    'payment_mode_id' 	=> 'required|exists:payment_modes',
                    'payment_mode' 	=> 'required',
                ]);

    	try{
    		// DB Transection Begin
            DB::beginTransaction();

            // Update Payment Mode In DB
            $payment_mode =  PaymentMode::find($request->payment_mode_id);
            $payment_mode->payment_mode = $request->payment_mode;
            $save_payment_mode = $payment_mode->save();

            // Check If Data Saved
            if ($save_payment_mode) {
            	# DB Commit And Return Success
            	DB::commit();
	            return redirect()->route('master.payment-mode')->with('success','Payment Mode Updated  SuccessFully.');
            } else {
            	# DB Roll Back And Return Error Message
            	DB::rollBack();
	            return back()->with('error','Fail To Update Payment Mode, Please Try Again.')->withInput();
            }
            
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage())->withInput();
        }
    }


    // Change Status Of Payment Mode
    public function statusPaymentMode($payment_mode_id)
    {
        # Validation
        $is_valid = PaymentMode::find($payment_mode_id);

        if ($is_valid) {
            # Change Status And Return Back
            if ($is_valid->status == 1) {
                # Make Status To 0
                $is_valid->status = 0;
                $is_valid->save();

                return redirect()->route('master.payment-mode')->with('success','Payment Mode Disabled SuccessFully.');
                
            } else {
                # Make status to 1
                $is_valid->status = 1;
                $is_valid->save();

                return redirect()->route('master.payment-mode')->with('success','PaymentMode Enabled SuccessFully.');
            }

        } else {
            # Return With Invalid Unit Id Error
            return back()->with('error','Invalid Payment Mode Id Please Try With Correct One');
        }
    }
//=============================Payment Mode Master Route End================//


//=============================Category Master Route Start================//

    #Get Category
    public function getCategorys()
    {
        # Get ALl Payment Modes
        $categories = Category::all();
        return View::make('app.master.category.list')->with('categories',$categories);
    }

    #Add Category
    public function addCategory()
    {
        # Return To View Page Of Add Payment Mode
        return View::make('app.master.category.add');
    }

    #Store Payment Mode
    public function storeCategory(Request $request)
    {
        // dd($request->all());
        # Validation
        $this->validate($request, [
                    'category'  => 'required|unique:categories',
                ]);

        try{
            // DB Transection Begin
            DB::beginTransaction();

            // Save New Category In DB
            $category = new Category;
            $category->category = $request->category;
            $save_category = $category->save();

            // Check If Data Saved
            if ($save_category) {
                # DB Commit And Return Success
                DB::commit();
                return redirect()->route('master.category')->with('success','Category Added  SuccessFully.');
            } else {
                # DB Roll Back And Return Error Message
                DB::rollBack();
                return back()->with('error','Fail To Store Category, Please Try Again.')->withInput();
            }
            
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage())->withInput();
        }
    }

    #Edit Category
    public function editCategory($category_id='')
    {
        # Validation
        $is_valid = Category::find($category_id);

        if ($is_valid) {
            # Return On Edit Page With Category Detail
            return View::make('app.master.category.edit')->with('category',$is_valid);
        } else {
            # Return With Invalid Category Id Error
            return back()->with('error','Invalid Category Id Please Try With Correct One');
        }
    }

    #update Category
    public function updateCategory(Request $request)
    {
        // dd($request->all());
        # Validation
        $this->validate($request, [
                    'category_id'   => 'required|exists:categories',
                    'category'  => 'required',
                ]);

        try{
            // DB Transection Begin
            DB::beginTransaction();

            // Update Category In DB
            $category =  Category::find($request->category_id);
            $category->category = $request->category;
            $save_category = $category->save();

            // Check If Data Saved
            if ($save_category) {
                # DB Commit And Return Success
                DB::commit();
                return redirect()->route('master.category')->with('success','Category Updated  SuccessFully.');
            } else {
                # DB Roll Back And Return Error Message
                DB::rollBack();
                return back()->with('error','Fail To Update Category, Please Try Again.')->withInput();
            }
            
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage())->withInput();
        }
    }


    // Change Status Of Category
    public function statusCategory($category_id)
    {
        # Validation
        $is_valid = Category::find($category_id);

        if ($is_valid) {
            # Change Status And Return Back
            if ($is_valid->status == 1) {
                # Make Status To 0
                $is_valid->status = 0;
                $is_valid->save();

                return redirect()->route('master.category')->with('success','Category Disabled SuccessFully.');
                
            } else {
                # Make status to 1
                $is_valid->status = 1;
                $is_valid->save();

                return redirect()->route('master.category')->with('success','PaymentMode Enabled SuccessFully.');
            }

        } else {
            # Return With Invalid Unit Id Error
            return back()->with('error','Invalid Category Id Please Try With Correct One');
        }
    }
//=============================Category Master Route End================//


}
