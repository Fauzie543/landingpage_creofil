<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LandingContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'img_url',
    ];

     // Ambil cache data landing content
    public static function getCachedContents()
    {
        return Cache::remember('cached_landing_contents', now()->addMinutes(10), function () {
            return self::orderBy('created_at', 'desc')->get();
        });
    }

    // Hapus cache saat ada perubahan data
    protected static function booted()
    {
        static::saved(fn () => Cache::forget('cached_landing_contents'));
        static::deleted(fn () => Cache::forget('cached_landing_contents'));
    }
}