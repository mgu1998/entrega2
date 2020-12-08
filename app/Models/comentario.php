<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comentario extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'comentario_id';
    public $incrementing = true;

    protected $fillable = [
        'noticia_id', 'texto', 'fecha', 'correo',
    ];

}
