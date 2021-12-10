<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('business_type_id')->nullable();
            $table->string('picture')->nullable();
            $table->string('address')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('call')->nullable();
            $table->string('website')->nullable();
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->boolean('approved')->default(true);
            $table->integer('popularity')->default(0);
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
        Schema::dropIfExists('businesses');
    }
}
