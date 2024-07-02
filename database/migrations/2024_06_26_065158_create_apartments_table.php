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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->smallInteger('number_rooms');
            $table->smallInteger('number_beds');
            $table->smallInteger('number_baths')->nullable();
            $table->smallInteger('square_meters')->nullable();
            $table->string('thumb');
            $table->string('address');
            $table->double('longitude', 15, 8);
            $table->double('latitude', 15, 8);
            $table->boolean('visibility')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments');
    }
};
