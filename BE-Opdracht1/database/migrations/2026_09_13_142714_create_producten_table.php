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
    Schema::create('producten', function (Blueprint $table) {
        $table->id('ProductId');
        $table->string('Naam', 100);
        $table->string('Barcode', 20)->unique();

        $table->boolean('IsActief')->default(true);
        $table->string('Opmerking', 250)->nullable();
        $table->dateTime('DatumAangemaakt', 6);
        $table->dateTime('DatumGewijzigd', 6)->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producten');
    }
};
