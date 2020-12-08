<?php

namespace App\Http\Controllers;

use App\Models\Enterprise;
use App\Models\Ticket;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{

    function index() {
        return view('index', ['cadena' => '<script>alert(1);</script><a href="https://google.es">enlace</a>', 'nombre' => 'pepe']);
    }
    
    function sql() {
        //$enterprises = \App\Models\Enterprise::where('name', '>', 's')->orderBy('contactperson', 'desc')->take(4)->get();
        //dd($enterprises);
        
        /*global $paso;
        $paso = 0;
        \App\Models\Ticket::chunk(7, function ($tickets) {
            global $paso;
            $paso = $paso + 1;
            echo 'Estoy en el paso: ' . $paso . '<br>';
            foreach ($tickets as $ticket) {
                echo $ticket->name . '<br>';
            }
        });*/
        
        /*foreach (\App\Models\Ticket::where('id', '>', 10)->cursor() as $ticket) {
            echo $ticket->name . '<br>';
        }*/
        
        /*$tickets = \App\Models\Ticket::cursor()->filter(function ($ticket) {
            //especificar condiciones muy complejas
            return $ticket->id > 50;
        });
        foreach ($tickets as $ticket) {
            echo $ticket->id . '<br>';
        }*/
        
        /* sacar los tickets a partir de un precio (40) de una empresa dada (Romero) */
        //empresa: Romero, 39
        /*$r = Ticket::select('name')->where('price', '>', 40)->where('identerprise', 39)->orderBy('price', 'desc')->get();
        dd($r);*/
        
        /*$r = Ticket::select('name')
            ->where('price', '>', 40)
            ->orderBy('price', 'desc')
            ->get();
        dd($r);*/
        
        /*$r = Enterprise::select('id')
             ->where('name', 'Romero')
             ->get();
        $r = Ticket::select('name')
            ->where('price', '>', 40)
            ->where('identerprise', $r[0]->id)
            ->orderBy('price', 'desc')
            ->get();
        dd($r);*/

        /*
        select ticket.*,
               (select id
                from enterprise
                where ticket.identerprise = enterprise.id and
                      enterprise.name = 'Romero') identerprise
        from ticket
        where price > 40
        */
        /*$r = Ticket::addSelect(['address' =>
                Enterprise::select('address')
                ->whereColumn('ticket.identerprise', 'enterprise.id')
                ->where('enterprise.name', 'Romero')
            ])->where('price', '>', 40)->get();
        dd($r);*/

        /*
        select ticket.*
        from ticket
        where price > 40 and 
              identerprise = (select id
                              from enterprise
                              where ticket.identerprise = enterprise.id and
                                     enterprise.name = 'Romero')
        */
        //subqueries -> Eloquent + DB + rawSql
        /*$r = Ticket::where('price', '>', 40)
                    ->where('identerprise', '=', (Enterprise::select('id')
                                                ->where('name', 'Romero')
                                                ->get())[0]->id)
                    ->get();
        dd($r);*/
             
        /*$r = Enterprise::addSelect(['ultimoticket' =>
            Ticket::select('name')
            ->whereColumn('identerprise', 'enterprise.id')
            ->orderBy('id', 'desc')
            ->limit(1)
        ])->get();
        dd($r);*/
        
        /*
        $r = Ticket::where('price', '<', 5)->delete();
        var_dump($r);
        */
        
        //db
        
        //$r es un array (colección) de objetos de la clase Enterprise
        /*$r = Enterprise::all();
        dd($r);*/
        
        //Hibernate (Java) : <-> Eloquent, Doctrine, etc. (ORM)
        //$r es un array de arrays con la estructura del registro
        //defino consulta 'sql' -> 
        $r = DB::select('select * from enterprise');
        dd($r);
        
        return view('sql');
    }

    function ejemplo(Request $request) {
        return view('middleware',['user' => $request->user, 'original' => $request->original]);
    }

    /*function sesion(Request $request) {
        $incrementar = $request->get('incrementar');
        $suma = 0;
        if($request->session()->exists('sumacontinua')) {
            $suma = $request->session()->get('sumacontinua');
        }
        $leer = Session::get('flash');
        $leer2 = request()->session()->get('flash');
        $suma = $suma + $incrementar;
        if($incrementar == 11) {
            $request->session()->flash('flash', $incrementar);
        }
        $request->session()->put('sumacontinua', $suma);
        return view('sesion', ['incrementar' => $incrementar, 'suma' => $suma]);
    }*/

    function sesion() {
        //Facades -> Facade\Request
        //Request, -> laravel los inyecta
        //request() -> $request
        //mucho caminos
        $incrementar = request()->get('incrementar');
        $suma = 0;
        if(request()->session()->exists('sumacontinua')) {
            $suma = request()->session()->get('sumacontinua');
        }
        $leer = Session::get('flash');
        $leer2 = request()->session()->get('flash');
        $suma = $suma + $incrementar;
        if($incrementar == 11) {
            request()->session()->flash('flash', $incrementar);
        }
        if($incrementar == 12) {
            request()->session()->reflash();
        }
        request()->session()->put('sumacontinua', $suma);
        return view('sesion', ['incrementar' => $incrementar, 'suma' => $suma]);
    }

    function logo($id) {
        $file = '/var/www/logo/' . $id;
        if(!file_exists($file)) {
            $file = '/var/www/logo/logo.png';
        }
        return response()->file($file);
    }

    function privada($id) {
        $file = '/var/www/privada/' . $id;
        if(!file_exists($file)) {
            $file = '/var/www/privada/no.png';
        }
        return response()->file($file);
    }
    
    /*  $results = DB::select('select * from ticket where id = :id', ['id' => 1]);
        $result = DB::insert('insert into enterprise (name, phone, contactperson, address, taxnumber)
                              values (:name, :phone, :contactperson, :address, :taxnumber)',
                              ['name' => 'Donde siempre', 'phone' => '958162534', 'contactperson' => 'Pepe', 'address' => 'c/Primavera, 10', 'taxnumber' => 'C18273645']);
        $result = DB::update('update ticket set price = 0.9 * price where identerprise = :identerprise', ['identerprise' => 2]);
        $result = DB::delete('delete from ticket where price > 95');
        $result = DB::table('enterprise')->get();
        $result = DB::table('enterprise')->find(3);
        $result = DB::table('enterprise')->where('id', '>', 10)->first();
        $result = DB::table('enterprise')->where('id', '>', 10)->value('contactperson');
        $result = DB::table('enterprise')->pluck('name', 'id');
        DB::table('users')->orderBy('id')->chunk(100, function ($users) {
            foreach ($users as $user) {
                //
            }
        });
        $users = DB::table('users')->count();
        $price = DB::table('orders')->max('price');
        $users = DB::table('users')->select('name', 'email')->get();
        $users = DB::table('users')->distinct()->get();
        $users = DB::table('users')
                     ->select(DB::raw('count(*) as user_count, status'))
                     ->where('status', '<>', 1)
                     ->groupBy('status')
                     ->get();
        $result = DB::table('enterprise')
                ->select('phone', 'taxnumber')
                ->groupByRaw('phone, taxnumber')
                ->get();
        $users = DB::table('users')
            ->join('contacts', 'users.id', '=', 'contacts.user_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.*', 'contacts.phone', 'orders.price')
            ->get();
        $users = DB::table('users')
            ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
            ->get();
        $users = DB::table('users')
            ->rightJoin('posts', 'users.id', '=', 'posts.user_id')
            ->get();
    */
}