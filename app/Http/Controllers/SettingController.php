<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use View;

class SettingController extends Controller
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
        return View::make('app.setting');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    #update Setting
    public function updateSettings(Request $request)
    {
        $data = $request->all();
        // dd($data);
        foreach ($data as $key => $val) {
            if ($key == 'logo' && $val != '' && $val != null) {
                # Save Image Path In DB

            } else {
                if ($val != '' && $val != null) {
                    # code...
                    Setting::add($key, $val, Setting::getDataType($key));
                } 
            }
        }

        return redirect()->back()->with('success', 'Settings has been Updated.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
