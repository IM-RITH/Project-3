<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_home_items', function (Blueprint $table) {
            $table->id();
            $table->text('heading');
            $table->text('text')->nullable();
            $table->text('job_title');
            $table->text('job_category');
            $table->text('job_location');
            $table->text('search');
            $table->text('background');
            $table->text('job_category_main_heading');
            $table->text('job_bcategory_sub_heading')->nullable();
            $table->text('job_category_status');
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
        Schema::dropIfExists('page_home_items');
    }
};