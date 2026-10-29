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

        DB::unprepared('DROP PROCEDURE IF EXISTS jamin_geleverde_producten');
        DB::unprepared(<<<'SQL'
            CREATE PROCEDURE jamin_geleverde_producten(IN p_leverancier_id BIGINT UNSIGNED)
            BEGIN
                SELECT p.ProductId, p.Naam, p.IsActief, m.AantalAanwezig,
                       m.VerpakkingsEenheidInKilogram,
                       MAX(ppl.DatumLevering) AS LaatsteLevering
                FROM product_per_leveranciers ppl
                JOIN producten p ON p.ProductId = ppl.ProductId
                LEFT JOIN magazijnen m ON m.ProductId = p.ProductId
                WHERE ppl.LeverancierId = p_leverancier_id AND ppl.IsActief = 1
                GROUP BY p.ProductId, p.Naam, p.IsActief, m.AantalAanwezig,
                         m.VerpakkingsEenheidInKilogram
                ORDER BY COALESCE(m.AantalAanwezig, 0) DESC, p.Naam ASC;
            END
            SQL);
    }

    public function down(): void
    {
        if (! in_array(DB::connection()->getDriverName(), ['mysql', 'mariadb'], true)) {
            return;
        }

        DB::unprepared('DROP PROCEDURE IF EXISTS jamin_geleverde_producten');
        DB::unprepared(<<<'SQL'
            CREATE PROCEDURE jamin_geleverde_producten(IN p_leverancier_id BIGINT UNSIGNED)
            BEGIN
                SELECT p.ProductId, p.Naam, p.IsActief, m.AantalAanwezig,
                       MAX(ppl.DatumLevering) AS LaatsteLevering
                FROM product_per_leveranciers ppl
                JOIN producten p ON p.ProductId = ppl.ProductId
                LEFT JOIN magazijnen m ON m.ProductId = p.ProductId
                WHERE ppl.LeverancierId = p_leverancier_id AND ppl.IsActief = 1
                GROUP BY p.ProductId, p.Naam, p.IsActief, m.AantalAanwezig
                ORDER BY COALESCE(m.AantalAanwezig, 0) DESC, p.Naam ASC;
            END
            SQL);
    }
};
