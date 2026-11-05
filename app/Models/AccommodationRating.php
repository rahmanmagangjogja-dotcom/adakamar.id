<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccommodationRating extends Model
{
    protected $fillable = [
        'accommodation_id',
        'nama',
        'email',
        'bintang',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'bintang' => 'integer',
        ];
    }

    public function accommodation(): BelongsTo
    {
        return $this->belongsTo(Accommodation::class);
    }
}