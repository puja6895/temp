<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use View;
use DB;

class CustomerController extends Controller
{
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
    public function index()
    {
        //Get All Customers And Return To View
        $customers = Customer::all();

        return View::make('app.customer.list')->with(['customers'=>$customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Return To Add Customer View
        return View::make('app.customer.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate
        $this->validate($request, [
                    'customer_name'     => 'required',
                    'customer_mobile'     => 'required|unique:customers',
                ]);

        try{
            // DB Transection Begin
            DB::beginTransaction();

            // Save Customer
            $customer = new Customer;
            $customer->customer_name = $request->customer_name;
            $customer->customer_email = $request->customer_email;
            $customer->customer_mobile = $request->customer_mobile;
            $customer->customer_address = $request->customer_address;
            $customer->save();

            DB::commit();
            // Return To Listing Page
            return redirect()->route('customers');

        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer,$customer_id)
    {
        //Is Valid 
        $is_valid = Customer::find($customer_id);
        if ($is_valid) {
            # Valid Then Return TO Edit Page With Data
            return View::make('app.customer.edit')->with(['customer'=>$is_valid]);
        } else {
            # InVlid Then Return Back With Error
            return back()->with('error','Invalid Customer ID Please Try With Valid ID.');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //Validate
        $this->validate($request, [
                    'customer_id'     => 'required|exists:customers',
                    'customer_name'     => 'required',
                    'customer_mobile'     => 'required|unique:customers,customer_mobile,'.$request->customer_id.',customer_id',
                ]);

        try{
            // DB Transection Begin
            DB::beginTransaction();

            // Update Customer
            $customer =  Customer::find($request->customer_id);
            $customer->customer_name = $request->customer_name;
            $customer->customer_email = $request->customer_email;
            $customer->customer_mobile = $request->customer_mobile;
            $customer->customer_address = $request->customer_address;
            $customer->save();

            DB::commit();
            // Return To Listing Page
            return redirect()->route('customers');

        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    // Customer Disable And Enable
    public function statusCustomer($customer_id)
    {
        # Validation
        $is_valid = Customer::find($customer_id);

        if ($is_valid) {
            # Change Status And Return Back
            if ($is_valid->customer_status == 1) {
                # Make Status To 0
                $is_valid->customer_status = 0;
                $is_valid->save();

                return redirect()->route('customers')->with('success','Customer Disabled SuccessFully.');
                
            } else {
                # Make status to 1
                $is_valid->customer_status = 1;
                $is_valid->save();

                return redirect()->route('customers')->with('success','Customer Enabled SuccessFully.');
            }

        } else {
            # Return With Invalid Customer Id Error
            return back()->with('error','Invalid Customer Id Please Try With Correct One');
        }
    }
}
