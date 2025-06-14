<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'img_url',
        'no_telp',
        'address',
        'email',
        'instagram',
        'latitude',
        'longitude',
    ];

    public $timestamps = false;

    protected static function booted()
    {
        static::creating(function ($company) {
            if (static::count() > 0) {
                throw new \Exception('Hanya diperbolehkan satu data company.');
            }
        });

        static::deleting(function ($company) {
            throw new \Exception('Tidak dapat menghapus data company.');
        });
    }
}