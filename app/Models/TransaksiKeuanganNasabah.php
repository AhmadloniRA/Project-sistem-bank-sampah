<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['nasabah_id', 'jenis_transaksi', 'nominal', 'saldo_terakhir', 'keterangan'])]
class TransaksiKeuanganNasabah extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transaksi_keuangan_nasabah';

    /**
     * Get the nasabah (user) that owns the transaction.
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
            'nominal' => 'integer',
            'saldo_terakhir' => 'integer',
        ];
    }
}
