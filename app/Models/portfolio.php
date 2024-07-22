<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'explanation',
        'images',
        'list',
    ];

    protected $casts = [
        'images' => 'array',
        'list' => 'array',
    ];
}