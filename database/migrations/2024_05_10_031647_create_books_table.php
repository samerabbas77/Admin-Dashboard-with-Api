<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('gategory_id')->nullable();
            $table->foreign('gategory_id')->references('id')->on('gategories')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('subGategory_id')->nullable();
            $table->foreign('subGategory_id')->references('id')->on('sub_gategories')->onDelete('cascade')->onUpdate('cascade');
            $table->string('publisher_name');
            $table->string('publish_date');
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
        Schema::dropIfExists('books');
    }
}
