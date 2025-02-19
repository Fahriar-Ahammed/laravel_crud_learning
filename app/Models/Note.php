<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'desc',
        'date',
        'status',
    ];

    protected $casts = [
        'date' => 'date', // Cast 'date' attribute to a Carbon date object.
    ];
}
