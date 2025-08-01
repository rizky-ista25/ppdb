<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    /** @use HasFactory<\Database\Factories\TimelineFactory> */
    use HasFactory;
    protected $fillable = [
        'judul',
        'konten',
        'icon',
        'color',
        'tanggal',
        'waktu',
    ];
}
