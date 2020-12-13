<?php
namespace App\Http\Controllers;
use App\Models\noticia;
use App\Models\comentario;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    
    public function index()
    {
        $noticias = noticia::all();
        
        // Enviamos los datos a la vista:
        return view('backend.noticias.index')->with(['noticias' => $noticias]);
    }
    
    
    
    
    public function indexfront()
    {
        $noticias = noticia::all();
        
        // Enviamos los datos a la vista:
        return view('frontend.index')->with(['noticias' => $noticias]);
    }
    
    
    
    
    public function create()
    {
        return view('backend.noticias.create');
        
    }
    
    
    
    public function store(Request $request)
    
    {
        $data = $request->all();
        noticia::create($data);
        $noticias = noticia::all();
        // Enviamos los datos a la vista:
        return view('backend.noticias.index')->with(['noticias' => $noticias]);
    
        
    }
    
       
       
       
    public function createfrontend()
    {
        return view('frontend.crear');
        
    }
    
    
    public function storefront(Request $request)
    {
        $data = $request->all();
        noticia::create($data);
        $noticias = noticia::all();
        // Enviamos los datos a la vista:
        return view('frontend.index')->with(['noticias' => $noticias]);
    
        
    }
    
    
    public function view($noticia_id)
    {
        $noticia = noticia::find($noticia_id);
        $comentarios = comentario::where('noticia_id', $noticia_id)->get();
        return view('backend.noticias.show')->with(['noticia' => $noticia, 'comentarios'=>$comentarios]);

    }
    
    
     public function viewfront($noticia_id)
     {
        $noticia = noticia::find($noticia_id);
        $comentarios = comentario::where('noticia_id', $noticia_id)->get();
        return view('frontend.show')->with(['noticia' => $noticia, 'comentarios'=>$comentarios]);

    }
      
    public function index_autor($autor_id)
    {
         $noticias = noticia::where('autor_id', $autor_id)->get();
         return view('backend.noticias.index')->with(['noticias' => $noticias]);

    }
    
       public function index_autor_front($autor_id)
    {
         $noticias = noticia::where('autor_id', $autor_id)->get();
         return view('frontend.index')->with(['noticias' => $noticias]);

    }
    
    
        
    public function destroy($noticia_id)
    {
         $noticia = noticia::find($noticia_id);        
  
        try {
                    $result = $noticia->delete();
                } catch(\Exception $e) {
                    $result = 0;
                }
        return redirect('backend/noticias');
            }
    
    }
