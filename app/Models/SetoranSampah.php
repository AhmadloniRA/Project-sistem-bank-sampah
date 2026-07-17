<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['nasabah_id', 'jenis_sampah', 'berat_kg', 'harga_beli_nasabah', 'harga_jual_pengepul', 'total_harga_nasabah', 'status'])]
class SetoranSampah extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'setoran_sampah';

    /**
     * Get the nasabah (user) that owns the setoran.
     */
    public function nasabah(): BelongsTo
    {
        return $this->belongsTo(User::class, 'nasabah_id');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'berat_kg' => 'double',
            'harga_beli_nasabah' => 'integer',
            'harga_jual_pengepul' => 'integer',
            'total_harga_nasabah' => 'integer',
        ];
    }
}
