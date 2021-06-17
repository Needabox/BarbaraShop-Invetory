<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PurchaseOrderLine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_line', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_order')->constrained('purchase_order')->onDelete('cascade');
            $table->foreignId('product')->constrained('products')->onDelete('restrict');
            $table->integer('qty');
            $table->integer('buy');
            $table->integer('grand_total');
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
        Schema::table('purchase_order_line', function (Blueprint $table) {
            //
        });
    }
}
