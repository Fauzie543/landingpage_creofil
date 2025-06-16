<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

     // Method custom untuk mendapatkan data dengan cache
    public static function getCachedCategories()
    {
        return Cache::remember('cached_categories', now()->addMinutes(10), function () {
            return self::orderBy('id', 'asc')->get();
        });
    }

    // Optional: Method untuk clear cache saat ada perubahan
    protected static function booted()
    {
        static::saved(fn () => Cache::forget('cached_categories'));
        static::deleted(fn () => Cache::forget('cached_categories'));
    }

    public function menus() {
        return $this->hasMany(Menu::class);
    }
    
}