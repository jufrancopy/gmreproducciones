<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimelinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timelines', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('profile_id');
            $table->foreign('profile_id')->references('id')->on('timeline-profils')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->string('title');
            $table->string('slug');
            $table->date('date');
            $table->string('file_path');
            $table->string('image');
            $table->text('description');
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
        Schema::dropIfExists('timelines');
    }
}
