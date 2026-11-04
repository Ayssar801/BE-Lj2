<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Leverancier extends Model
{
    protected $table = 'leveranciers';

    protected $primaryKey = 'LeverancierId';

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
}
