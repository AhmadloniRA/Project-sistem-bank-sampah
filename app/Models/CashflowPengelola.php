<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['jenis_aliran', 'nominal', 'kategori', 'keterangan', 'sisa_saldo_kas'])]
class CashflowPengelola extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cashflow_pengelola';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'nominal' => 'integer',
            'sisa_saldo_kas' => 'integer',
        ];
    }
}
