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
    Schema::create('product_per_allergenen', function (Blueprint $table) {
        $table->id('ProductPerAllergeenId');

        $table->unsignedBigInteger('ProductId');
        $table->unsignedBigInteger('AllergeenId');

        $table->boolean('IsActief')->default(true);
        $table->string('Opmerking', 250)->nullable();
        $table->dateTime('DatumAangemaakt', 6);
        $table->dateTime('DatumGewijzigd', 6)->nullable();

        $table->foreign('ProductId')
            ->references('ProductId')
            ->on('producten')
            ->onDelete('cascade');

        $table->foreign('AllergeenId')
            ->references('AllergeenId')
            ->on('allergenen')
            ->onDelete('cascade');

        $table->unique(['ProductId', 'AllergeenId']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_per_allergenen');
    }
};
