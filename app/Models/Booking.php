<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'nama_customer', 'no_hp', 'tanggal', 'jam', 'status', 'catatan'];

    protected $casts = ['tanggal' => 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function isSlotTaken(string $tanggal, string $jam, ?int $excludeId = null): bool
    {
        $query = static::where('tanggal', $tanggal)
            ->where('jam', $jam)
            ->whereIn('status', ['pending', 'approved']);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }

    public static function getBookedSlots(string $tanggal): array
    {
        return static::where('tanggal', $tanggal)
            ->whereIn('status', ['pending', 'approved'])
            ->pluck('jam')
            ->map(fn($j) => substr($j, 0, 5))
            ->toArray();
    }
}
