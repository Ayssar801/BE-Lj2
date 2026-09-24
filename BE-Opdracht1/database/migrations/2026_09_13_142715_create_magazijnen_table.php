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
    Schema::create('magazijnen', function (Blueprint $table) {
        $table->id('MagazijnId');

        $table->unsignedBigInteger('ProductId');
        $table->decimal('VerpakkingsEenheidInKilogram', 5, 2);
        $table->unsignedInteger('AantalAanwezig')->nullable();

        $table->boolean('IsActief')->default(true);
        $table->string('Opmerking', 250)->nullable();
        $table->dateTime('DatumAangemaakt', 6);
        $table->dateTime('DatumGewijzigd', 6)->nullable();

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
        Schema::dropIfExists('magazijnen');
    }
};
