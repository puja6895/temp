<?php

namespace App\Http\Controllers;

use App\Ladger;
use App\PaymentMode;
use App\Purchase;
use App\PurchaseOrderPayment;
use Auth;
use DB;
use Illuminate\Http\Request;
use View;

class FinancialController extends Controller {
	/**
     * Allow Only Authenticated Users
     */

    public function __construct() {
		$this->middleware('auth');
    }
	/**
	 * Get List Of Recievables
	 * @response: List Of Pending and Partial Sales
	 */
	public function getReceivables() {
		$sells = Sell::join('sell_amount')->where('status',1)->get();

		return $sells;
	}

	/**
	 * Get List of Payables
	 * @response: List Of Pending Or Partial Payment Status of Purchase Orders
	 */
	public function getPayables() {
		$purchases = Purchase::with('purchase_payments')->where('purchase_status', '!=', 3)->orderBy('due_date')->get();

		$total_amount = 0;
		$paid_amount = 0;
		foreach ($purchases as $purchase) {
			$total_amount += $purchase->purchase_amount->grand_total;
			$paid_amount += $purchase->purchase_payments->sum('paid_amount');
		}

		return View::make('app.payables.list')->with(['purchases' => $purchases, 'total_amount' => $total_amount, 'paid_amount' => $paid_amount]);
	}

	/**
	 * Get Payable Payment Record Form
	 * @response Return The Form View
	 */
	public function payablesPayment($purchase_id) {
		# Search For Purchase
		$purchase = Purchase::with('purchase_payments.mode')->where('purchase_id', $purchase_id)->first();

		if (isset($purchase) && !empty($purchase)) {
			if ($purchase->purchase_status != 3) {
				# If Purchase Unpaid
				# Then Check For Amount Remaining

				$remaining_amount = $purchase->purchase_amount->grand_total - $purchase->purchase_payments->sum('paid_amount');

				if ($remaining_amount > 0) {
					# Return To View Page For Capture Payment
					$payment_modes = PaymentMode::all();
					return View::make('app.payables.payment')->with(['remaining_amount' => $remaining_amount, 'purchase' => $purchase, 'paid_amount' => $purchase->purchase_payments->sum('paid_amount'), 'payment_modes' => $payment_modes]);
				} else {
					# Return Error Message
					return back()->with('error', 'Selected Purchase Order Already Paid.');
				}

			} else {
				# Return Error For Paid Invoice

				return back()->with('error', 'Selected Purchase Order Already Paid.');
			}

		}
	}

	/**
	 * Store Payment Against Purchase Order
	 * @param : $[request] [All Form Data]
	 * @response: Store Payment And Update Status of Purchase Order
	 */
	public function capturePayablesPayment(Request $request) {
		// dd($request->all());
		//Validate
		$this->validate($request, [
			'purchase_id' => 'required|exists:purchases,purchase_id',
			'payment_mode' => 'required|exists:payment_modes,payment_mode_id',
			'amount_paid' => 'required',
			'remaining_amount' => 'required',
		]);
		try {
			// DB Transection Begin
			DB::beginTransaction();

			$purchase = Purchase::with('purchase_payments')->where('purchase_id', $request->purchase_id)->first();

			#Check Remaining Payments
			if ($request->amount_paid > $request->remaining_amount) {
				return back()->with('error', 'Payment Amount Paid Should be Less Than Remaining Amount.')->withInput();
			}

			$remaining_amount = $request->remaining_amount - $request->amount_paid;

			#if Ref Image
			if ($request->hasFile('ref_image')) {
				$imageName = time() . '-' . $request->ref_image->getClientOriginalName();

				$request->ref_image->move(public_path('uploads'), $imageName);
			}

			#save captured payments
			$payment = new PurchaseOrderPayment;
			$payment->purchase_id = $request->purchase_id;
			$payment->paid_amount = $request->amount_paid;
			$payment->payament_mode = $request->payment_mode;
			$payment->ref = isset($request->referance) ? $request->referance : '';
			$payment->ref_image = isset($imageName) ? $imageName : '';
			$payment->paid_by = Auth::user()->id;
			$payment->save();

			#Update Status Of Purchase
			if ($remaining_amount == 0) {
				$purchase->purchase_status = 3;
				$purchase->save();
			} else {
				if ($purchase->purchase_status == 1) {
					$purchase->purchase_status = 2;
					$purchase->save();
				}
			}

			#Mark Entry In Ladger
			$ladger_data = array('purchase_payment_id' => $purchase->purchase_id, 'debit_amount' => $request->amount_paid, 'remarks' => 'Payment Made For Purchase Order of Amount of ' . $request->amount_paid);
			Ladger::create($ladger_data);

			#Commit Data
			DB::commit();

			return redirect()->route('purchase.show', ['id' => $purchase->purchase_id])->with('success', 'Payment Capture Successfully And Updated in Purchase Order Paymnet.');
		} catch (\Exception $e) {
			DB::rollBack();
			return back()->with('error', $e->getMessage())->withInput();
		}

	}

	/**
	 * Get List Of Invoice
	 * @response: Return All Invoice Created With Thier Status
	 */
	public function getInvoiceList() {
		# code...
	}

	/**
	 * Create Invoice List
	 * @response: Return Invoice Create FORM
	 */
	public function createInvoice() {
		# code...
	}

	/**
	 * Store Invoice
	 * @param: $request
	 * @response: Store Invoice Details
	 */
	public function storeInvoice(Request $request) {
		# code...
	}

	/**
	 * Capture Payment Against Invoice
	 * @param: $request
	 */
	public function recordPaymentOfInvoice(Request $request) {
		# code...
	}

	/**
	 * Print Invoice
	 * @param: $invoice_id
	 * @response: Print Dilogue with Save And Print
	 */
	public function printInvoice($invoice_id) {
		# code...
	}
}
