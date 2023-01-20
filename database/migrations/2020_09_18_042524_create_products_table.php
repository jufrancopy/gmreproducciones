<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('status');
            $table->string('code')->default(0);
            $table->string('name');
            $table->string('slug');
            
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->string('file_path');
            $table->string('image');
            $table->decimal('price', 11, 3);
            $table->integer('inventory')->default(0);
            $table->integer('in_discount');
            $table->integer('discount');
            $table->text('content');
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
