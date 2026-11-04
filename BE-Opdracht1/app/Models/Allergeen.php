<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Allergeen extends Model
{
    protected $table = 'allergenen';

    protected $primaryKey = 'AllergeenId';

    protected $fillable = [
        'Naam',
        'Omschrijving',
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

    public function producten(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'product_per_allergenen',
            'AllergeenId',
            'ProductId',
            'AllergeenId',
            'ProductId'
        )->withPivot([
            'ProductPerAllergeenId',
            'IsActief',
            'Opmerking',
        ])->withTimestamps('DatumAangemaakt', 'DatumGewijzigd');
    }
}
