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
        return view('frontend.index')->with(['noticias' => $noticias]);
    }

            
    public function destroy($comentario_id)
    {
         $comentario = comentario::find($comentario_id);        
  
        try {
                    $result = $comentario->delete();
                } catch(\Exception $e) {
                    $result = 0;
                }
        return redirect('backend/noticias');
            }
    }
