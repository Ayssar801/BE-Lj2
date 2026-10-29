<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (! in_array(DB::connection()->getDriverName(), ['mysql', 'mariadb'], true)) {
            return;
        }

        foreach ([
            'producten',
            'magazijnen',
            'allergenen',
            'product_per_allergenen',
            'leveranciers',
            'product_per_leveranciers',
        ] as $table) {
            DB::statement(
                "ALTER TABLE `{$table}`
                 MODIFY `Opmerking` VARCHAR(255) NULL,
                 MODIFY `DatumGewijzigd` DATETIME(6) NULL
                    DEFAULT CURRENT_TIMESTAMP(6)
                    ON UPDATE CURRENT_TIMESTAMP(6)"
            );
        }
    }

    public function down(): void
    {
        if (! in_array(DB::connection()->getDriverName(), ['mysql', 'mariadb'], true)) {
            return;
        }

        foreach ([
            'producten',
            'magazijnen',
            'allergenen',
            'product_per_allergenen',
            'leveranciers',
            'product_per_leveranciers',
        ] as $table) {
            DB::statement(
                "ALTER TABLE `{$table}`
                 MODIFY `Opmerking` VARCHAR(250) NULL,
                 MODIFY `DatumGewijzigd` DATETIME(6) NULL DEFAULT NULL"
            );
        }
    }
};
