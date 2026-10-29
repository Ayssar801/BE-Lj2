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

        DB::unprepared('DROP PROCEDURE IF EXISTS jamin_overzicht_leveranciers');
        DB::unprepared(<<<'SQL'
            CREATE PROCEDURE jamin_overzicht_leveranciers()
            BEGIN
                SELECT l.LeverancierId, l.Naam, l.ContactPersoon, l.LeverancierNummer, l.Mobiel,
                       COUNT(DISTINCT ppl.ProductId) AS AantalVerschillendeProducten
                FROM leveranciers l
                LEFT JOIN product_per_leveranciers ppl
                    ON ppl.LeverancierId = l.LeverancierId AND ppl.IsActief = 1
                WHERE l.IsActief = 1
                GROUP BY l.LeverancierId, l.Naam, l.ContactPersoon, l.LeverancierNummer, l.Mobiel
                ORDER BY AantalVerschillendeProducten DESC, l.Naam ASC;
            END
            SQL);

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
                GROUP BY p.ProductId, p.Naam, p.IsActief, m.AantalAanwezig
                ORDER BY COALESCE(m.AantalAanwezig, 0) DESC, p.Naam ASC;
            END
            SQL);

        DB::unprepared('DROP PROCEDURE IF EXISTS jamin_voeg_levering_toe');
        DB::unprepared(<<<'SQL'
            CREATE PROCEDURE jamin_voeg_levering_toe(
                IN p_leverancier_id BIGINT UNSIGNED,
                IN p_product_id BIGINT UNSIGNED,
                IN p_aantal INT UNSIGNED,
                IN p_datum_levering DATE,
                IN p_datum_eerst_volgende_levering DATE
            )
            BEGIN
                DECLARE v_product_actief BOOLEAN DEFAULT FALSE;

                SELECT IsActief INTO v_product_actief
                FROM producten
                WHERE ProductId = p_product_id
                FOR UPDATE;

                IF v_product_actief AND EXISTS (
                    SELECT 1
                    FROM product_per_leveranciers
                    WHERE LeverancierId = p_leverancier_id
                      AND ProductId = p_product_id
                      AND IsActief = 1
                ) THEN
                    INSERT INTO product_per_leveranciers
                        (LeverancierId, ProductId, DatumLevering, Aantal, DatumEerstVolgendeLevering,
                         IsActief, Opmerking, DatumAangemaakt, DatumGewijzigd)
                    VALUES
                        (p_leverancier_id, p_product_id, p_datum_levering, p_aantal,
                         p_datum_eerst_volgende_levering, 1, NULL, NOW(6), NULL);

                    UPDATE magazijnen
                    SET AantalAanwezig = COALESCE(AantalAanwezig, 0) + p_aantal,
                        DatumGewijzigd = NOW(6)
                    WHERE ProductId = p_product_id;

                    IF ROW_COUNT() <> 1 THEN
                        SIGNAL SQLSTATE '45000'
                            SET MESSAGE_TEXT = 'Voor dit product is geen magazijnrecord gevonden.';
                    END IF;

                    SELECT 1 AS Opgeslagen;
                ELSE
                    SELECT 0 AS Opgeslagen;
                END IF;
            END
            SQL);
    }

    public function down(): void
    {
        if (! in_array(DB::connection()->getDriverName(), ['mysql', 'mariadb'], true)) {
            return;
        }

        DB::unprepared('DROP PROCEDURE IF EXISTS jamin_voeg_levering_toe');
        DB::unprepared('DROP PROCEDURE IF EXISTS jamin_geleverde_producten');
        DB::unprepared('DROP PROCEDURE IF EXISTS jamin_overzicht_leveranciers');
    }
};
