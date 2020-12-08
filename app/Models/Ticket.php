<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    
    //hay que declarar las variables de instancia
    //nombre de la tabla, obligatorio
    protected $table = 'ticket';
    
    //nombre del campo que forma la clave primaria -> id autonumérico -> id, no necesario
    //protected $primaryKey = 'id';
    
    //fecha de creación del registro, fecha de la última edición del registro, predeterminado true
    //public $timestamps = false;
    
    //tabla ticket: id, created_at, updated_at
    
    protected $fillable = ['identerprise', 'name', 'price', 'initialdate', 'finaldate', 'initialtime', 'finaltime', 'description'];
    
    protected $hidden = ['profit'];
    
    protected $guarded = ['profit', 'active'];
    
    /* aparte */
    
    protected $attributes = ['profit' => 15.0, 'active' => true];
    
    public function enterprise() {
        return $this->belongsTo('App\Models\Enterprise', 'identerprise');
        //return $this->belongsTo('App\Models\Enterprise', 'identerprise', 'id');
        //return $this->belongsTo('App\Models\Post', 'foreign_key', 'owner_key');
        //return $this->hasMany('App\Models\Comment', 'foreign_key', 'local_key');
        //return $this->metodo('Modelo', 'idXXX', 'id');
        //return $this->metodo('Modelo', 'idXXX');
    }
}
