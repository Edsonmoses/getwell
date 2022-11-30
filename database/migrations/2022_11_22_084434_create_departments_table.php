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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('subtitle');
            $table->longText('desc');
            $table->string('image');
            $table->string('toptitle')->nullable();
            $table->string('topsubtitle')->nullable();
            $table->string('status')->nullable();
            $table->bigInteger('department_id')->unsigned()->nullable();
            $table->bigInteger('timetable_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('department_id')->references('id')->on('department_lists')->onDelete('cascade');
            $table->foreign('timetable_id')->references('id')->on('workings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
};
