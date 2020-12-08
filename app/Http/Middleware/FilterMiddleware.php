<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FilterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //comprobar alguna condición
        /*if($request->input('user') !== 'pepe') {
            return redirect('/');
        }
        return $next($request);*/

        //agregar o modificar información de la petición
        /*$request->original = $request->user;
        $request->user = strtoupper($request->user);
        $request->aplicacion = 'MIDDLEWARE';
        $request->request->add(['variable' => 'value']);
        return $next($request);*/

        //compartir información con la vista
        //view()->share('aplicacion', 'Tickets APP');
        //view()->share('name', ['one' => 'uno']);
        /*view()->share(['one' => 'uno', 'aplicacion' => 'otro']);
        return $next($request);*/

        $response = $next($request);
        $text = $response->getOriginalContent();// . '<h1>publicidad</h1>';
        //</body> -> reemplazar publicidad+</body>
        $text = str_replace('</body>', '<h1>publicidad</h1></body>', $text);
        $array = [
            'Lorem' => 'L***m',
            'Ipsum' => 'I^^^m',
            'texto' => '<span style="color: #ff0000;">códice</span>'
        ];
        foreach($array as $oldword => $newword) {
            $text = str_replace($oldword, $newword, $text);
        }
        //$text = str_replace('Lorem', 'L***m', $text);
        $response->setContent($text);
        return $response;

        //dd($request);
        //dd($request->aplicacion . ' ' . $request->nombre);
    }
}
