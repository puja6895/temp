<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('sells', function (Blueprint $table) {
			$table->increments('sell_id');
			$table->integer('customer_id');
			$table->date('sell_date');
			$table->tinyInteger('is_gst')->default(0);
			$table->tinyInteger('sell_status')->default(1);
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
		Schema::dropIfExists('sells');
	}
}
