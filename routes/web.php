<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\BackendEnterpriseController;
use App\Http\Controllers\BackendTicketController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TicketController;
//use App\Http\Middleware\FilterMiddleware;
use App\Http\Middleware\AfterMiddleware;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//frontend
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('sql', [IndexController::class, 'sql'])->name('sql');
Route::get('logo/{id}', [IndexController::class, 'logo'])->name('logo');
Route::get('privada/{id}', [IndexController::class, 'privada'])->name('privada');
Route::get('sesion', [IndexController::class, 'sesion'])->name('sesion');
Route::resource('ticket', TicketController::class, ['names' => 'ticket'])->only(['index', 'show']);

//backend
Route::get('backend', [BackendController::class, 'main'])->name('backend.main');
Route::resource('backend/ticket', BackendTicketController::class, ['names' => 'backend.ticket']);
Route::resource('backend/enterprise', BackendEnterpriseController::class, ['names' => 'backend.enterprise']);
Route::get('backend/ticket/create/{identerprise}', [BackendTicketController::class, 'createTicketEp'])->name('backend.ticket.createticketep');
Route::get('backend/ticket/{identerprise}/tickets', [BackendTicketController::class, 'showTickets'])->name('backend.ticket.showtickets');

Route::get('middleware', [IndexController::class, 'ejemplo'])->middleware('censure');
Route::get('after', [IndexController::class, 'ejemplo'])->middleware(AfterMiddleware::class);
Route::get('backend/noticias/crear', 'App\Http\Controllers\NoticiaController@create')->name('backend.noticias.create');
Route::post('backend/noticias/crear', 'App\Http\Controllers\NoticiaController@store');
Route::get('backend/noticias/', 'App\Http\Controllers\NoticiaController@index')->name('backend.noticias.index');
Route::get('backend/noticias/{noticia_id}', 'App\Http\Controllers\NoticiaController@view');
Route::post('backend/comentarios/crear', 'App\Http\Controllers\ComentarioController@store');
Route::get('backend/noticias/autor/{autor_id}', 'App\Http\Controllers\NoticiaController@index_autor');
Route::delete('backend/noticias/{noticia_id}', 'App\Http\Controllers\NoticiaController@destroy');

Route::get('/noticias/', 'App\Http\Controllers\NoticiaController@indexfront')->name('noticias.index');
Route::get('/noticias/{noticia_id}', 'App\Http\Controllers\NoticiaController@viewfront');
Route::get('/noticias/crear-noticia', 'App\Http\Controllers\NoticiaController@indexfront');
Route::post('/noticias/crear', 'App\Http\Controllers\NoticiaController@storefront');
Route::get('/noticias/autor/{autor_id}', 'App\Http\Controllers\NoticiaController@index_autor_front');
Route::post('backend/noticias/comentarios/{comentario_id}', 'App\Http\Controllers\ComentarioController@destroy');



