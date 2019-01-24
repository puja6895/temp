<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('purchases', function (Blueprint $table) {
			$table->increments('purchase_id');
			$table->integer('purchaser_id');
			$table->date('purchase_date');
			$table->date('due_date');
			$table->tinyInteger('is_gst')->default(0);
			$table->tinyInteger('purchase_status')->default(1);
			$table->integer('created_by');
			$table->integer('updated_by')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('purchases');
	}
}
