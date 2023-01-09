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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('designation');
            $table->string('desc');
            $table->longText('bio');
            $table->longText('education');
            $table->string('specialeft');
            $table->string('specialr');
            $table->string('address');
            $table->string('email');
            $table->string('phone');
            $table->string('hours');
            $table->string('facebook');
            $table->string('linkedin');
            $table->string('twitter');
            $table->string('image');
            $table->string('status');
            $table->string('postedby');
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->bigInteger('department_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('department_id')->references('id')->on('department_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
};
