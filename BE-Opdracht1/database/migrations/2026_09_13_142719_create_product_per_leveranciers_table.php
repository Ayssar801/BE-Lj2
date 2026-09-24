<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('product_per_leveranciers', function (Blueprint $table) {
        $table->id('ProductPerLeverancierId');

        $table->unsignedBigInteger('LeverancierId');
        $table->unsignedBigInteger('ProductId');
        $table->date('DatumLevering');
        $table->unsignedInteger('Aantal');
        $table->date('DatumEerstVolgendeLevering')->nullable();

        $table->boolean('IsActief')->default(true);
        $table->string('Opmerking', 250)->nullable();
        $table->dateTime('DatumAangemaakt', 6);
        $table->dateTime('DatumGewijzigd', 6)->nullable();

        $table->foreign('LeverancierId')
            ->references('LeverancierId')
            ->on('leveranciers')
            ->onDelete('cascade');

             $table->foreign('ProductId')
            ->references('ProductId')
            ->on('producten')
            ->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_per_leveranciers');
    }
};
