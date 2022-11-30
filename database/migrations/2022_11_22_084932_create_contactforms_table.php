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
        Schema::create('contactforms', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('subject')->nullable();
            $table->string('phone')->nullable();
            $table->longText('msg')->nullable();
            $table->string('postedby')->nullable();
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
        Schema::dropIfExists('contactforms');
    }
};
