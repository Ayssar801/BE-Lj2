<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class Leverancier extends Model
{
    // Bevat de gegevens van leveranciers.
    protected $table = 'leveranciers';

    protected $primaryKey = 'LeverancierId';

    protected $fillable = [
        'Naam',
        'ContactPersoon',
        'LeverancierNummer',
        'Mobiel',
        'IsActief',
        'Opmerking',
    ];

    public const CREATED_AT = 'DatumAangemaakt';

    public const UPDATED_AT = 'DatumGewijzigd';

    public static function overzicht(): Collection
    {
        return static::query()
            ->select([
                'LeverancierId',
                'Naam',
                'ContactPersoon',
                'LeverancierNummer',
                'Mobiel',
            ])
            ->selectSub(
                DB::table('product_per_leveranciers as ppl')
                    ->selectRaw('COUNT(DISTINCT ppl.ProductId)')
                    ->whereColumn('ppl.LeverancierId', 'leveranciers.LeverancierId')
                    ->where('ppl.IsActief', true),
                'AantalVerschillendeProducten'
            )
            ->where('IsActief', true)
            ->orderByDesc('AantalVerschillendeProducten')
            ->orderBy('Naam')
            ->get();
    }

    public function geleverdeProducten(): Collection
    {
        return Product::query()
            ->join('product_per_leveranciers as ppl', 'ppl.ProductId', '=', 'producten.ProductId')
            ->leftJoin('magazijnen as m', 'm.ProductId', '=', 'producten.ProductId')
            ->where('ppl.LeverancierId', $this->getKey())
            ->where('ppl.IsActief', true)
            ->select([
                'producten.ProductId',
                'producten.Naam',
                'producten.IsActief',
                'm.AantalAanwezig',
                'm.VerpakkingsEenheidInKilogram',
            ])
            ->selectRaw('MAX(ppl.DatumLevering) AS LaatsteLevering')
            ->groupBy(
                'producten.ProductId',
                'producten.Naam',
                'producten.IsActief',
                'm.AantalAanwezig',
                'm.VerpakkingsEenheidInKilogram'
            )
            ->orderByRaw('COALESCE(m.AantalAanwezig, 0) DESC')
            ->orderBy('producten.Naam')
            ->get();
    }

    public function productVoorLevering(int $productId): ?self
    {
        return static::query()
            ->join('product_per_leveranciers as ppl', 'ppl.LeverancierId', '=', 'leveranciers.LeverancierId')
            ->join('producten as p', 'p.ProductId', '=', 'ppl.ProductId')
            ->where('leveranciers.LeverancierId', $this->getKey())
            ->where('ppl.ProductId', $productId)
            ->where('ppl.IsActief', true)
            ->where('leveranciers.IsActief', true)
            ->select([
                'leveranciers.LeverancierId',
                'leveranciers.Naam as LeverancierNaam',
                'leveranciers.ContactPersoon',
                'leveranciers.LeverancierNummer',
                'leveranciers.Mobiel',
                'p.ProductId',
                'p.Naam as ProductNaam',
                'p.IsActief as ProductIsActief',
            ])
            ->first();
    }

    public function voegLeveringToe(
        int $productId,
        int $aantal,
        string $datumEerstVolgendeLevering
    ): bool {
        return DB::transaction(function () use ($productId, $aantal, $datumEerstVolgendeLevering): bool {
            $product = Product::query()
                ->whereKey($productId)
                ->lockForUpdate()
                ->first();

            if (
                ! $product
                || ! $product->IsActief
                || ! static::query()->whereKey($this->getKey())->where('IsActief', true)->exists()
                || ! ProductPerLeverancier::query()
                    ->where('LeverancierId', $this->getKey())
                    ->where('ProductId', $productId)
                    ->where('IsActief', true)
                    ->exists()
            ) {
                return false;
            }

            ProductPerLeverancier::query()->insert([
                'LeverancierId' => $this->getKey(),
                'ProductId' => $productId,
                'DatumLevering' => now()->toDateString(),
                'Aantal' => $aantal,
                'DatumEerstVolgendeLevering' => $datumEerstVolgendeLevering,
                'IsActief' => true,
                'Opmerking' => null,
                'DatumAangemaakt' => now()->format('Y-m-d H:i:s.u'),
                'DatumGewijzigd' => null,
            ]);

            $bijgewerkteMagazijnen = Magazijn::query()
                ->where('ProductId', $productId)
                ->increment('AantalAanwezig', $aantal, ['DatumGewijzigd' => now()]);

            if ($bijgewerkteMagazijnen !== 1) {
                throw new RuntimeException('Voor dit product is geen magazijnrecord gevonden.');
            }

            return true;
        });
    }

    protected function casts(): array
    {
        return [
            'IsActief' => 'boolean',
            'DatumAangemaakt' => 'datetime',
            'DatumGewijzigd' => 'datetime',
        ];
    }

    // Een leverancier kan meerdere producten leveren.
    public function producten(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'product_per_leveranciers',
            'LeverancierId',
            'ProductId',
            'LeverancierId',
            'ProductId'
        )->withPivot([
            'ProductPerLeverancierId',
            'DatumLevering',
            'Aantal',
            'DatumEerstVolgendeLevering',
            'IsActief',
            'Opmerking',
        ])->withTimestamps('DatumAangemaakt', 'DatumGewijzigd');
    }

    // Levert de losse leveringsregels van deze leverancier.
    public function leveringen(): HasMany
    {
        return $this->hasMany(ProductPerLeverancier::class, 'LeverancierId', 'LeverancierId');
    }
}
