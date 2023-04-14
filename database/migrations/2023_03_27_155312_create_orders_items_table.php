<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_items', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('order_id');
            $table->integer('product_id');
            $table->integer('inventory_id');
            $table->integer('variant_id')->nullable();
            $table->text('label_item')->nullable();
            $table->text('quantity')->default(1);
            $table->integer('discount_status')->default(0);
            $table->date('discount_until_date')->nullable();
            $table->integer('discount')->default(0);
            $table->decimal('price_initial', 11,2);
            $table->decimal('price_unit', 11,2);
            $table->decimal('total', 11,2);
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
        Schema::dropIfExists('orders_items');
    }
}
