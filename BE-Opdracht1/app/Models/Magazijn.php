<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Magazijn extends Model
{
    // Bevat de voorraad- en verpakkingsgegevens van een product.
    protected $table = 'magazijnen';

    protected $primaryKey = 'MagazijnId';

    protected $fillable = [
        'ProductId',
        'VerpakkingsEenheidInKilogram',
        'AantalAanwezig',
        'IsActief',
        'Opmerking',
    ];

    public const CREATED_AT = 'DatumAangemaakt';

    public const UPDATED_AT = 'DatumGewijzigd';

    protected function casts(): array
    {
        return [
            'VerpakkingsEenheidInKilogram' => 'decimal:2',
            'AantalAanwezig' => 'integer',
            'IsActief' => 'boolean',
            'DatumAangemaakt' => 'datetime',
            'DatumGewijzigd' => 'datetime',
        ];
    }

    // Ieder magazijnrecord hoort bij één product.
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'ProductId', 'ProductId');
    }
}
