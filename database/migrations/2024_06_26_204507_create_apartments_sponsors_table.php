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
        Schema::create('apartments_sponsors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_sponsor');
            $table->unsignedBigInteger('id_apartment');
            $table->timestamp('start_time')->useCurrent();
            $table->timestamp('end_time')->useCurrent();
            $table->timestamps();

            $table->foreign('id_sponsor')
            ->references('id')
            ->on('sponsors')
            ->onDelete('cascade');

            $table->foreign('id_apartment')
            ->references('id')
            ->on('apartments')
            ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sponsor_apartment');
    }
};
