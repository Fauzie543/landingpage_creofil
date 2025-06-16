<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'category_id', 'price', 'description', 'img_url', 'status',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    // Ambil menu dengan cache
    public static function getCachedMenus()
    {
        return Cache::remember('cached_menus', now()->addMinutes(10), function () {
            return self::with('category')->orderBy('id')->get();
        });
    }

    // Hapus cache jika ada perubahan
    protected static function booted()
    {
        static::saved(fn () => Cache::forget('cached_menus'));
        static::deleted(fn () => Cache::forget('cached_menus'));
    }
}