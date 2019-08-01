<?php

namespace App\Http\Controllers;

use App\Purchaser;
use Illuminate\Http\Request;
use View;
use DB;

class PurchaserController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get All Purchasers And Return To View
        $purchasers = Purchaser::all();

        return View::make('app.purchaser.list')->with(['purchasers'=>$purchasers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Return To Add Purchaser View
        return View::make('app.purchaser.add');
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
                    'purchaser_name'     => 'required',
                    'purchaser_mobile'     => 'required|unique:purchasers',
                ]);

        try{
            // DB Transection Begin
            DB::beginTransaction();

            // Save Purchaser
            $purchaser = new Purchaser;
            $purchaser->purchaser_name = $request->purchaser_name;
            $purchaser->purchaser_email = $request->purchaser_email;
            $purchaser->purchaser_mobile = $request->purchaser_mobile;
            $purchaser->purchaser_address = $request->purchaser_address;
            $purchaser->company = $request->company;
            $purchaser->save();

            DB::commit();
            // Return To Listing Page
            return redirect()->route('purchasers');

        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Purchaser  $purchaser
     * @return \Illuminate\Http\Response
     */
    public function show(Purchaser $purchaser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchaser  $purchaser
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchaser $purchaser,$purchaser_id)
    {
        //Is Valid 
        $is_valid = Purchaser::find($purchaser_id);
        if ($is_valid) {
            # Valid Then Return TO Edit Page With Data
            return View::make('app.purchaser.edit')->with(['purchaser'=>$is_valid]);
        } else {
            # InVlid Then Return Back With Error
            return back()->with('error','Invalid Purchaser ID Please Try With Valid ID.');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchaser  $purchaser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchaser $purchaser)
    {
        //Validate
        $this->validate($request, [
                    'purchaser_id'     => 'required|exists:purchasers',
                    'purchaser_name'     => 'required',
                    'purchaser_mobile'     => 'required|unique:purchasers,purchaser_mobile,'.$request->purchaser_id.',purchaser_id',
                ]);

        try{
            // DB Transection Begin
            DB::beginTransaction();

            // Update Purchaser
            $purchaser =  Purchaser::find($request->purchaser_id);
            $purchaser->purchaser_name = $request->purchaser_name;
            $purchaser->purchaser_email = $request->purchaser_email;
            $purchaser->purchaser_mobile = $request->purchaser_mobile;
            $purchaser->purchaser_address = $request->purchaser_address;
            $purchaser->company = $request->company;
            $purchaser->save();

            DB::commit();
            // Return To Listing Page
            return redirect()->route('purchasers');

        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchaser  $purchaser
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchaser $purchaser)
    {
        //
    }

    // Purchaser Disable And Enable
    public function statusPurchaser($purchaser_id)
    {
        # Validation
        $is_valid = Purchaser::find($purchaser_id);

        if ($is_valid) {
            # Change Status And Return Back
            if ($is_valid->purchaser_status == 1) {
                # Make Status To 0
                $is_valid->purchaser_status = 0;
                $is_valid->save();

                return redirect()->route('purchasers')->with('success','Purchaser Disabled SuccessFully.');
                
            } else {
                # Make status to 1
                $is_valid->purchaser_status = 1;
                $is_valid->save();

                return redirect()->route('purchasers')->with('success','Purchaser Enabled SuccessFully.');
            }

        } else {
            # Return With Invalid Purchaser Id Error
            return back()->with('error','Invalid Purchaser Id Please Try With Correct One');
        }
    }
}
