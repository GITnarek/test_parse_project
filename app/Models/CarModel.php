<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $name
 * @property string $url
 */
class CarModel extends Model
{
    public array $country_market = [
        'russia',
        'japan',
        'europe',
        'usa',
        'south-korea'
    ];

    protected $fillable = [
        'name',
        'url',
    ];
    public $timestamps = true;

    /**
     * @return HasMany
     */
    public function generations(): HasMany
    {
        return $this->hasMany(Generation::class);
    }
}
