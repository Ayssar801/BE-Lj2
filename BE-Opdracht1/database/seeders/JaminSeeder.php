<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JaminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datum = now();

        DB::table('producten')->insertOrIgnore([
            ['ProductId' => 1, 'Naam' => 'Mintnopjes', 'Barcode' => '8719587231278', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductId' => 2, 'Naam' => 'Schoolkrijt', 'Barcode' => '8719587326713', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductId' => 3, 'Naam' => 'Honingdrop', 'Barcode' => '8719587327836', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductId' => 4, 'Naam' => 'Zure Beren', 'Barcode' => '8719587321441', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductId' => 5, 'Naam' => 'Cola Flesjes', 'Barcode' => '8719587321237', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductId' => 6, 'Naam' => 'Turtles', 'Barcode' => '8719587322245', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductId' => 7, 'Naam' => 'Witte Muizen', 'Barcode' => '8719587328256', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductId' => 8, 'Naam' => 'Reuzen Slangen', 'Barcode' => '8719587325641', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductId' => 9, 'Naam' => 'Zoute Rijen', 'Barcode' => '8719587322739', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductId' => 10, 'Naam' => 'Winegums', 'Barcode' => '8719587327527', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductId' => 11, 'Naam' => 'Drop Munten', 'Barcode' => '8719587322345', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductId' => 12, 'Naam' => 'Kruis Drop', 'Barcode' => '8719587322265', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductId' => 13, 'Naam' => 'Zoute Ruitjes', 'Barcode' => '8719587323256', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
        ]);

        DB::table('magazijnen')->insertOrIgnore([
            ['MagazijnId' => 1, 'ProductId' => 1, 'VerpakkingsEenheidInKilogram' => 5, 'AantalAanwezig' => 453, 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['MagazijnId' => 2, 'ProductId' => 2, 'VerpakkingsEenheidInKilogram' => 2.5, 'AantalAanwezig' => 400, 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['MagazijnId' => 3, 'ProductId' => 3, 'VerpakkingsEenheidInKilogram' => 5, 'AantalAanwezig' => 1, 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['MagazijnId' => 4, 'ProductId' => 4, 'VerpakkingsEenheidInKilogram' => 1, 'AantalAanwezig' => 800, 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['MagazijnId' => 5, 'ProductId' => 5, 'VerpakkingsEenheidInKilogram' => 3, 'AantalAanwezig' => 234, 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['MagazijnId' => 6, 'ProductId' => 6, 'VerpakkingsEenheidInKilogram' => 2, 'AantalAanwezig' => 345, 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['MagazijnId' => 7, 'ProductId' => 7, 'VerpakkingsEenheidInKilogram' => 1, 'AantalAanwezig' => 795, 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['MagazijnId' => 8, 'ProductId' => 8, 'VerpakkingsEenheidInKilogram' => 10, 'AantalAanwezig' => 233, 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['MagazijnId' => 9, 'ProductId' => 9, 'VerpakkingsEenheidInKilogram' => 2.5, 'AantalAanwezig' => 123, 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['MagazijnId' => 10, 'ProductId' => 10, 'VerpakkingsEenheidInKilogram' => 3, 'AantalAanwezig' => null, 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['MagazijnId' => 11, 'ProductId' => 11, 'VerpakkingsEenheidInKilogram' => 2, 'AantalAanwezig' => 367, 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['MagazijnId' => 12, 'ProductId' => 12, 'VerpakkingsEenheidInKilogram' => 1, 'AantalAanwezig' => 467, 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['MagazijnId' => 13, 'ProductId' => 13, 'VerpakkingsEenheidInKilogram' => 5, 'AantalAanwezig' => 20, 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
        ]);

        DB::table('leveranciers')->insertOrIgnore([
            ['LeverancierId' => 1, 'Naam' => 'Venco', 'ContactPersoon' => 'Bert van Linge', 'LeverancierNummer' => 'L1029384719', 'Mobiel' => '06-28493827', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['LeverancierId' => 2, 'Naam' => 'Astra Sweets', 'ContactPersoon' => 'Jasper del Monte', 'LeverancierNummer' => 'L1029284315', 'Mobiel' => '06-39398734', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['LeverancierId' => 3, 'Naam' => 'Haribo', 'ContactPersoon' => 'Sven Stalman', 'LeverancierNummer' => 'L1029324748', 'Mobiel' => '06-24383291', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['LeverancierId' => 4, 'Naam' => 'Basset', 'ContactPersoon' => 'Joyce Stelterberg', 'LeverancierNummer' => 'L1023845773', 'Mobiel' => '06-48293823', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['LeverancierId' => 5, 'Naam' => 'De Bron', 'ContactPersoon' => 'Remco Veenstra', 'LeverancierNummer' => 'L1023857736', 'Mobiel' => '06-34291234', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
        ]);

        DB::table('product_per_leveranciers')->insertOrIgnore([
            ['ProductPerLeverancierId' => 1, 'LeverancierId' => 1, 'ProductId' => 1, 'DatumLevering' => '2024-10-09', 'Aantal' => 23, 'DatumEerstVolgendeLevering' => '2024-10-16', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductPerLeverancierId' => 2, 'LeverancierId' => 1, 'ProductId' => 1, 'DatumLevering' => '2024-10-18', 'Aantal' => 21, 'DatumEerstVolgendeLevering' => '2024-10-25', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductPerLeverancierId' => 3, 'LeverancierId' => 1, 'ProductId' => 2, 'DatumLevering' => '2024-10-09', 'Aantal' => 12, 'DatumEerstVolgendeLevering' => '2024-10-16', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductPerLeverancierId' => 4, 'LeverancierId' => 1, 'ProductId' => 3, 'DatumLevering' => '2024-10-10', 'Aantal' => 11, 'DatumEerstVolgendeLevering' => '2024-10-17', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductPerLeverancierId' => 5, 'LeverancierId' => 2, 'ProductId' => 4, 'DatumLevering' => '2024-10-14', 'Aantal' => 16, 'DatumEerstVolgendeLevering' => '2024-10-21', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductPerLeverancierId' => 6, 'LeverancierId' => 2, 'ProductId' => 4, 'DatumLevering' => '2024-10-21', 'Aantal' => 23, 'DatumEerstVolgendeLevering' => '2024-10-28', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductPerLeverancierId' => 7, 'LeverancierId' => 2, 'ProductId' => 5, 'DatumLevering' => '2024-10-14', 'Aantal' => 45, 'DatumEerstVolgendeLevering' => '2024-10-21', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductPerLeverancierId' => 8, 'LeverancierId' => 2, 'ProductId' => 6, 'DatumLevering' => '2024-10-14', 'Aantal' => 30, 'DatumEerstVolgendeLevering' => '2024-10-21', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductPerLeverancierId' => 9, 'LeverancierId' => 3, 'ProductId' => 7, 'DatumLevering' => '2024-10-12', 'Aantal' => 12, 'DatumEerstVolgendeLevering' => '2024-10-19', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductPerLeverancierId' => 10, 'LeverancierId' => 3, 'ProductId' => 7, 'DatumLevering' => '2024-10-19', 'Aantal' => 23, 'DatumEerstVolgendeLevering' => '2024-10-26', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductPerLeverancierId' => 11, 'LeverancierId' => 3, 'ProductId' => 8, 'DatumLevering' => '2024-10-10', 'Aantal' => 12, 'DatumEerstVolgendeLevering' => '2024-10-17', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductPerLeverancierId' => 12, 'LeverancierId' => 3, 'ProductId' => 9, 'DatumLevering' => '2024-10-11', 'Aantal' => 1, 'DatumEerstVolgendeLevering' => '2024-10-18', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductPerLeverancierId' => 13, 'LeverancierId' => 4, 'ProductId' => 10, 'DatumLevering' => '2024-10-16', 'Aantal' => 24, 'DatumEerstVolgendeLevering' => '2023-04-30', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductPerLeverancierId' => 14, 'LeverancierId' => 5, 'ProductId' => 11, 'DatumLevering' => '2024-10-10', 'Aantal' => 47, 'DatumEerstVolgendeLevering' => '2024-10-17', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductPerLeverancierId' => 15, 'LeverancierId' => 5, 'ProductId' => 11, 'DatumLevering' => '2024-10-19', 'Aantal' => 60, 'DatumEerstVolgendeLevering' => '2024-10-26', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductPerLeverancierId' => 16, 'LeverancierId' => 5, 'ProductId' => 12, 'DatumLevering' => '2024-10-11', 'Aantal' => 45, 'DatumEerstVolgendeLevering' => null, 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductPerLeverancierId' => 17, 'LeverancierId' => 5, 'ProductId' => 13, 'DatumLevering' => '2024-10-12', 'Aantal' => 23, 'DatumEerstVolgendeLevering' => null, 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
        ]);

        DB::table('allergenen')->insertOrIgnore([
            ['AllergeenId' => 1, 'Naam' => 'Gluten', 'Omschrijving' => 'Dit product bevat gluten', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['AllergeenId' => 2, 'Naam' => 'Gelatine', 'Omschrijving' => 'Dit product bevat gelatine', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['AllergeenId' => 3, 'Naam' => 'AZO-Kleurstof', 'Omschrijving' => 'Dit product bevat AZO-kleurstoffen', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['AllergeenId' => 4, 'Naam' => 'Lactose', 'Omschrijving' => 'Dit product bevat lactose', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['AllergeenId' => 5, 'Naam' => 'Soja', 'Omschrijving' => 'Dit product bevat soja', 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
        ]);

        DB::table('product_per_allergenen')->insertOrIgnore([
            ['ProductPerAllergeenId' => 1, 'ProductId' => 1, 'AllergeenId' => 2, 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductPerAllergeenId' => 2, 'ProductId' => 1, 'AllergeenId' => 1, 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductPerAllergeenId' => 3, 'ProductId' => 1, 'AllergeenId' => 3, 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductPerAllergeenId' => 4, 'ProductId' => 3, 'AllergeenId' => 4, 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductPerAllergeenId' => 5, 'ProductId' => 6, 'AllergeenId' => 5, 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductPerAllergeenId' => 6, 'ProductId' => 9, 'AllergeenId' => 2, 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductPerAllergeenId' => 7, 'ProductId' => 9, 'AllergeenId' => 5, 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductPerAllergeenId' => 8, 'ProductId' => 10, 'AllergeenId' => 2, 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductPerAllergeenId' => 9, 'ProductId' => 12, 'AllergeenId' => 4, 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductPerAllergeenId' => 10, 'ProductId' => 13, 'AllergeenId' => 1, 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductPerAllergeenId' => 11, 'ProductId' => 13, 'AllergeenId' => 4, 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
            ['ProductPerAllergeenId' => 12, 'ProductId' => 13, 'AllergeenId' => 5, 'IsActief' => true, 'Opmerking' => null, 'DatumAangemaakt' => $datum, 'DatumGewijzigd' => null],
        ]);
    }
}
