<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentroCivico extends Model
{
    use HasFactory;

    protected $table = 'centros_civicos'; // Nombre real de la tabla en la BD

    protected $fillable = ['nombre', 'direccion', 'telefono', 'horario', 'foto']; // Campos permitidos para inserción masiva
    public $timestamps = false; // Desactiva created_at y updated_at
}
