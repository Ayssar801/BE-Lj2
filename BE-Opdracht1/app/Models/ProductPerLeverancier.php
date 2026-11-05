<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPerLeverancier extends Model
{
    // Koppelt een leverancier aan een product en bewaart de leveringsgegevens.
    protected $table = 'product_per_leveranciers';

    protected $primaryKey = 'ProductPerLeverancierId';

    protected $fillable = [
        'LeverancierId',
        'ProductId',
        'DatumLevering',
        'Aantal',
        'DatumEerstVolgendeLevering',
        'IsActief',
        'Opmerking',
    ];

    public const CREATED_AT = 'DatumAangemaakt';

    public const UPDATED_AT = 'DatumGewijzigd';

    protected function casts(): array
    {
        return [
            'DatumLevering' => 'date',
            'DatumEerstVolgendeLevering' => 'date',
            'Aantal' => 'integer',
            'IsActief' => 'boolean',
            'DatumAangemaakt' => 'datetime',
            'DatumGewijzigd' => 'datetime',
        ];
    }

    // Elke leveringsregel verwijst naar één product.
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'ProductId', 'ProductId');
    }

    // Elke leveringsregel verwijst naar één leverancier.
    public function leverancier(): BelongsTo
    {
        return $this->belongsTo(Leverancier::class, 'LeverancierId', 'LeverancierId');
    }
}
