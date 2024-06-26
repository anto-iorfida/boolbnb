<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('views', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('apartment_id')->nullable();
            $table->string('ip_address');
            $table->dateTime('date_time');
            $table->timestamps();

            $table->foreign('apartment_id')
                ->references('id')
                ->on('apartments')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('views');
    }
};
