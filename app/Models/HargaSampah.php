<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['jenis_sampah', 'harga_beli_nasabah', 'harga_jual_pengepul'])]
class HargaSampah extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'harga_sampah';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'harga_beli_nasabah' => 'integer',
            'harga_jual_pengepul' => 'integer',
        ];
    }
}
