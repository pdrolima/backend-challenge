<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
       'launches' => 'array',
        'events' => 'array'
    ];

    public const CREATED_AT = 'publishedAt';

    public const UPDATED_AT = 'updatedAt';
}
