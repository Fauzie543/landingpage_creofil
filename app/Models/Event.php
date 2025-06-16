<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'poster_image',
        'start_time',
        'end_time',
        'location',
        'slug',
    ];

    // Ambil semua event dengan cache
    public static function getCachedEvents()
    {
        return Cache::remember('cached_events', now()->addMinutes(10), function () {
            return self::orderBy('start_time', 'desc')->get();
        });
    }

    // Reset cache jika event diubah
    protected static function booted()
    {
        static::saved(fn () => Cache::forget('cached_events'));
        static::deleted(fn () => Cache::forget('cached_events'));
        static::restored(fn () => Cache::forget('cached_events'));
    }
}