<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poster extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'img_url', 'status'];

    // Ambil data dari cache atau simpan baru kalau belum ada
    public static function getCachedPosters()
    {
        return Cache::remember('cached_posters', now()->addMinutes(10), function () {
            return self::orderBy('created_at', 'desc')->get();
        });
    }

    // Reset cache otomatis saat data poster diubah
    protected static function booted()
    {
        static::saved(fn () => Cache::forget('cached_posters'));
        static::deleted(fn () => Cache::forget('cached_posters'));
    }
}