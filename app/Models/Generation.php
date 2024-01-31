<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $market
 * @property string $name
 * @property string $period
 * @property string $generation
 * @property string $image_path
 * @property string $tech_specs_path
 */
class Generation extends Model
{
    protected $fillable = [
        'market',
        'name',
        'period',
        'generation',
        'image_path',
        'tech_specs_path'
    ];
    public $timestamps = true;

    /**
     * @return BelongsTo
     */
    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class);
    }
}
