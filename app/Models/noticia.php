<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class noticia extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'noticia_id';
    public $incrementing = true;

    protected $fillable = [
        'noticia_uuid', 'titulo', 'texto', 'imagen', 'autor_id', 'fecha',
    ];

    
}
 
