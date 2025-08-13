<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'original_url',
        'short_code',
    ];
}
