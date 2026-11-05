<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    // Koppelt dit model aan de eigen tabel- en sleutelnaam in de database.
    protected $table = 'producten';

    protected $primaryKey = 'ProductId';

    protected $fillable = [
        'Naam',
        'Barcode',
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

    // Eloquent laadt de gekoppelde voorraadgegevens via deze relatie.
    public function magazijn(): HasOne
    {
        return $this->hasOne(Magazijn::class, 'ProductId', 'ProductId');
    }

    // Producten en leveranciers zijn gekoppeld via de leveringstabel.
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

    // Bevat de afzonderlijke leveringsregels van dit product.
    public function leveringen(): HasMany
    {
        return $this->hasMany(ProductPerLeverancier::class, 'ProductId', 'ProductId');
    }

    // Producten en allergenen zijn many-to-many gekoppeld via een koppeltabel.
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
