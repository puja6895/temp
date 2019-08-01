<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryLogsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('inventory_logs', function (Blueprint $table) {
			$table->increments('inventory_log_id');
			$table->integer('product_id');
			$table->decimal('credit', 8, 2);
			$table->decimal('debit', 8, 2);
			$table->tinyInteger('type');
			$table->integer('unit_id');
			$table->tinyInteger('inventory_log_status')->default(1);
			$table->integer('created_by');
			$table->longText('comment')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('inventory_logs');
	}
}
