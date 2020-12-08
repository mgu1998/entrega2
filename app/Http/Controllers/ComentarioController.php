<?php

namespace App\Http\Controllers;
use App\Models\comentario;
use App\Models\noticia;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
public function create()
    {
        return view('comentarios.crear');
        
    }
    
public function store(Request $request)
    {
        $data = $request->all();
     
        $noticias=noticia::all();
        comentario::create($data);
        return view('backend.noticias.index')->with(['noticias' => $noticias]);
    }
}
