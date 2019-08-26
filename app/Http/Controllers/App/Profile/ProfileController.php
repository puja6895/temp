<?php

namespace App\Http\Controllers\App\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use View;
use App\User;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Allow Only Authenticated Users
     */

    public function __construct() {
		$this->middleware('auth');
    }
    
    /**
     * To Get Profile Details
     * @param Authenticated User
     * @response Details of User
     */
    public function index()
    {
        try {
            //code...
            $user_info = User::find(Auth::user()->id);
            return View::make('app.profile.profile',compact('user_info'));
        } catch (\Exception $e) {
            return View::make('errors.400')->with('exception',$e);
        }
    }

    /**
     * TO Change password
     * @params $old_password, $new_password, $confirm_new_password
     * @response Change Password Success
     * @Author: Shani Singh
     */
    public function changePassword(Request $request)
    {
        #Validation
		$this->validate($request, [
			'old_password' => 'required',
			'password' => 'required|string|min:6|confirmed',

		]);
		try {

			DB::beginTransaction();

			$old_password = $request->old_password;

			if (Hash::check($old_password, Auth::user()->password)) {
				# code...
				$new_pass = Hash::make($request->password);
				$user = User::where('id', Auth::user()->id)->first();
				$user->password = $new_pass;
				$save = $user->save();
				if ($save) {
					DB::commit();
					return back()->with('success', 'password chnaged successfully.');
				} else {
					DB::rollBack();
					return back()->with('error', 'Something went wrong.');
				}
			} else {
				DB::rollBack();
				return back()->with('error', 'Please Enter Correct Old Password.');
			}
		} catch (\Exception $e) {
			DB::rollBack();
			return back()->with('error', $e->getMessage())->withInput();
		}
    }
}
