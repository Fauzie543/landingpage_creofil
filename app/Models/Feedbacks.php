<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedbacks extends Model
{
    protected $table = 'feedbacks';

    protected $fillable = [
        'name',
        'email',
        'message',
        'status',
    ];
}