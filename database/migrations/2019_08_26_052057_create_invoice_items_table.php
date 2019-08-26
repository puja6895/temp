<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->increments('invoice_item_id');
            $table->bigInteger('invoice_id');
            $table->bigInteger('product_id');
            $table->string('product_name');
            $table->string('product_detail')->nullable();
            $table->double('rate', 10, 2);
            $table->double('quantity', 10, 2);
            $table->double('tax', 10, 2)->default(0);
            $table->double('tax_amount', 10, 2)->default(0);
            $table->double('amount', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_items');
    }
}
