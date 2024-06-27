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
    Schema::create('apartments_services', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_apartment');
        $table->unsignedBigInteger('id_service');
        $table->timestamps();

        $table->foreign('id_apartment')
            ->references('id')
            ->on('apartments')
            ->onDelete('cascade');

        $table->foreign('id_service')
            ->references('id')
            ->on('services')
            ->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apartments_services', function (Blueprint $table) {
            $table->dropForeign(['id_apartment']);
            $table->dropForeign(['id_service']);
        });

        Schema::dropIfExists('apartments_services');
    }
};
