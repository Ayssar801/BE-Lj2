<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
