<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    protected $table = 'producten';

    protected $primaryKey = 'ProductId';

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

    public function magazijn(): HasOne
    {
        return $this->hasOne(Magazijn::class, 'ProductId', 'ProductId');
    }

    public function leveranciers(): BelongsToMany
    {
        return $this->belongsToMany(
            Leverancier::class,
            'product_per_leveranciers',
            'ProductId',
            'LeverancierId',
            'ProductId',
            'LeverancierId'
        )->withPivot([
            'ProductPerLeverancierId',
            'DatumLevering',
            'Aantal',
            'DatumEerstVolgendeLevering',
            'IsActief',
            'Opmerking',
        ])->withTimestamps('DatumAangemaakt', 'DatumGewijzigd');
    }

    public function allergenen(): BelongsToMany
    {
        return $this->belongsToMany(
            Allergeen::class,
            'product_per_allergenen',
            'ProductId',
            'AllergeenId',
            'ProductId',
            'AllergeenId'
        )->withPivot([
            'ProductPerAllergeenId',
            'IsActief',
            'Opmerking',
        ])->withTimestamps('DatumAangemaakt', 'DatumGewijzigd');
    }
}
