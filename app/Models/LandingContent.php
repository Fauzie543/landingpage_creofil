<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LandingContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'img_url',
    ];
}