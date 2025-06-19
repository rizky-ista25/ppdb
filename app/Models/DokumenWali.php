<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenWali extends Model
{
    /** @use HasFactory<\Database\Factories\DokumenWaliFactory> */
    use HasFactory;

    protected $table = 'dokumen_wali';
}
