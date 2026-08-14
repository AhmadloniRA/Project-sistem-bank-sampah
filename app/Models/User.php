<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['no_id', 'name', 'email', 'password', 'role', 'kk_number', 'phone_number', 'address', 'total_tabungan', 'profile_photo'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the setoran sampah logs for the user.
     */
    public function setoranSampah(): HasMany
    {
        return $this->hasMany(SetoranSampah::class, 'nasabah_id');
    }

    /**
     * Get the financial transactions for the user.
     */
    public function transaksiKeuangan(): HasMany
    {
        return $this->hasMany(TransaksiKeuanganNasabah::class, 'nasabah_id');
    }

    /**
     * Generate a unique member ID (no_id).
     */
    public static function generateUniqueNoId(): string
    {
        $year = now()->format('Y');
        $prefix = 'BS-' . $year . '-';

        $maxSequence = 0;
        $existingNoIds = static::where('no_id', 'like', $prefix . '%')->pluck('no_id');

        foreach ($existingNoIds as $noId) {
            $parts = explode('-', $noId);
            $seq = (int) end($parts);
            if ($seq > $maxSequence) {
                $maxSequence = $seq;
            }
        }

        $sequence = max($maxSequence + 1, static::count() + 1);

        do {
            $candidate = $prefix . str_pad($sequence, 3, '0', STR_PAD_LEFT);
            $exists = static::where('no_id', $candidate)->exists();
            if ($exists) {
                $sequence++;
            }
        } while ($exists);

        return $candidate;
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted()
    {
        static::creating(function ($user) {
            if (empty($user->no_id)) {
                $user->no_id = static::generateUniqueNoId();
            }
        });
    }

    /**
     * Check if the user has admin role.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user has user role.
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
