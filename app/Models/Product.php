<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'foto',
        'precio',
        'dosis',
        'descripcion',
        'cultivo',
        'etapa',
        'enabled',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'enabled' => 'boolean',
    ];
}
