<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use PDO;
use RuntimeException;

class LeverancierRepository
{
    public function getLeveranciers(): array
    {
        $pdo = DB::connection()->getPdo();

        if ($pdo->getAttribute(PDO::ATTR_DRIVER_NAME) === 'mysql') {
            $statement = $pdo->query('CALL jamin_overzicht_leveranciers()');
            $leveranciers = $statement->fetchAll(PDO::FETCH_OBJ);
            $statement->closeCursor();

            return $leveranciers;
        }

        if ($pdo->getAttribute(PDO::ATTR_DRIVER_NAME) !== 'sqlite') {
            throw new RuntimeException('De leveranciersdatabase wordt niet ondersteund.');
        }

        return $pdo->query(
            'SELECT l.LeverancierId, l.Naam, l.ContactPersoon, l.LeverancierNummer, l.Mobiel,
                    COUNT(DISTINCT ppl.ProductId) AS AantalVerschillendeProducten
             FROM leveranciers l
             LEFT JOIN product_per_leveranciers ppl
                ON ppl.LeverancierId = l.LeverancierId AND ppl.IsActief = 1
             WHERE l.IsActief = 1
             GROUP BY l.LeverancierId, l.Naam, l.ContactPersoon, l.LeverancierNummer, l.Mobiel
             ORDER BY AantalVerschillendeProducten DESC, l.Naam ASC'
        )->fetchAll(PDO::FETCH_OBJ);
    }

    public function getLeverancier(int $leverancierId): ?object
    {
        $statement = DB::connection()->getPdo()->prepare(
            'SELECT LeverancierId, Naam, ContactPersoon, LeverancierNummer, Mobiel
             FROM leveranciers
             WHERE LeverancierId = :leverancier_id AND IsActief = 1'
        );
        $statement->execute(['leverancier_id' => $leverancierId]);

        return $statement->fetch(PDO::FETCH_OBJ) ?: null;
    }

    public function getGeleverdeProducten(int $leverancierId): array
    {
        $pdo = DB::connection()->getPdo();

        if ($pdo->getAttribute(PDO::ATTR_DRIVER_NAME) === 'mysql') {
            $statement = $pdo->prepare('CALL jamin_geleverde_producten(?)');
            $statement->execute([$leverancierId]);
            $producten = $statement->fetchAll(PDO::FETCH_OBJ);
            $statement->closeCursor();

            return $producten;
        }

        if ($pdo->getAttribute(PDO::ATTR_DRIVER_NAME) !== 'sqlite') {
            throw new RuntimeException('De leveranciersdatabase wordt niet ondersteund.');
        }

        $statement = $pdo->prepare(
            'SELECT p.ProductId, p.Naam, p.IsActief,
                    m.AantalAanwezig, m.VerpakkingsEenheidInKilogram,
                    MAX(ppl.DatumLevering) AS LaatsteLevering
             FROM product_per_leveranciers ppl
             JOIN producten p ON p.ProductId = ppl.ProductId
             LEFT JOIN magazijnen m ON m.ProductId = p.ProductId
             WHERE ppl.LeverancierId = :leverancier_id AND ppl.IsActief = 1
             GROUP BY p.ProductId, p.Naam, p.IsActief, m.AantalAanwezig,
                      m.VerpakkingsEenheidInKilogram
             ORDER BY COALESCE(m.AantalAanwezig, 0) DESC, p.Naam ASC'
        );
        $statement->execute(['leverancier_id' => $leverancierId]);

        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function getLeverancierProduct(int $leverancierId, int $productId): ?object
    {
        $statement = DB::connection()->getPdo()->prepare(
            'SELECT l.LeverancierId, l.Naam AS LeverancierNaam, l.ContactPersoon,
                    l.LeverancierNummer, l.Mobiel,
                    p.ProductId, p.Naam AS ProductNaam, p.IsActief AS ProductIsActief
             FROM product_per_leveranciers ppl
             JOIN leveranciers l ON l.LeverancierId = ppl.LeverancierId
             JOIN producten p ON p.ProductId = ppl.ProductId
             WHERE ppl.LeverancierId = :leverancier_id
               AND ppl.ProductId = :product_id
               AND ppl.IsActief = 1
               AND l.IsActief = 1
             LIMIT 1'
        );
        $statement->execute([
            'leverancier_id' => $leverancierId,
            'product_id' => $productId,
        ]);

        return $statement->fetch(PDO::FETCH_OBJ) ?: null;
    }

    public function voegLeveringToe(
        int $leverancierId,
        int $productId,
        int $aantal,
        string $datumEerstVolgendeLevering
    ): bool {
        $connection = DB::connection();
        $pdo = $connection->getPdo();

        return $connection->transaction(function () use (
            $pdo,
            $leverancierId,
            $productId,
            $aantal,
            $datumEerstVolgendeLevering
        ): bool {
            if ($pdo->getAttribute(PDO::ATTR_DRIVER_NAME) === 'mysql') {
                $statement = $pdo->prepare('CALL jamin_voeg_levering_toe(?, ?, ?, ?, ?)');
                $statement->execute([
                    $leverancierId,
                    $productId,
                    $aantal,
                    now()->toDateString(),
                    $datumEerstVolgendeLevering,
                ]);
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                $statement->closeCursor();

                if ($result === false || ! array_key_exists('Opgeslagen', $result)) {
                    throw new RuntimeException('De opgeslagen levering gaf geen geldig resultaat terug.');
                }

                return (bool) $result['Opgeslagen'];
            }

            if ($pdo->getAttribute(PDO::ATTR_DRIVER_NAME) !== 'sqlite') {
                throw new RuntimeException('De leveranciersdatabase wordt niet ondersteund.');
            }

            $activeProduct = $pdo->prepare(
                'SELECT p.IsActief
                 FROM producten p
                 JOIN product_per_leveranciers ppl ON ppl.ProductId = p.ProductId
                 WHERE ppl.LeverancierId = :leverancier_id
                   AND ppl.ProductId = :product_id
                   AND ppl.IsActief = 1'
            );
            $activeProduct->execute([
                'leverancier_id' => $leverancierId,
                'product_id' => $productId,
            ]);

            if (! (bool) $activeProduct->fetchColumn()) {
                return false;
            }

            $datumLevering = now()->toDateString();
            $insert = $pdo->prepare(
                'INSERT INTO product_per_leveranciers
                    (LeverancierId, ProductId, DatumLevering, Aantal, DatumEerstVolgendeLevering,
                     IsActief, Opmerking, DatumAangemaakt, DatumGewijzigd)
                 VALUES
                    (:leverancier_id, :product_id, :datum_levering, :aantal,
                     :datum_eerst_volgende_levering, 1, NULL, :datum_aangemaakt, NULL)'
            );
            $insert->execute([
                'leverancier_id' => $leverancierId,
                'product_id' => $productId,
                'datum_levering' => $datumLevering,
                'aantal' => $aantal,
                'datum_eerst_volgende_levering' => $datumEerstVolgendeLevering,
                'datum_aangemaakt' => now()->format('Y-m-d H:i:s.u'),
            ]);

            $update = $pdo->prepare(
                'UPDATE magazijnen
                 SET AantalAanwezig = COALESCE(AantalAanwezig, 0) + :aantal,
                     DatumGewijzigd = :datum_gewijzigd
                 WHERE ProductId = :product_id'
            );
            $update->execute([
                'aantal' => $aantal,
                'datum_gewijzigd' => now()->format('Y-m-d H:i:s.u'),
                'product_id' => $productId,
            ]);

            if ($update->rowCount() !== 1) {
                throw new RuntimeException('Voor dit product is geen magazijnrecord gevonden.');
            }

            return true;
        });
    }
}
