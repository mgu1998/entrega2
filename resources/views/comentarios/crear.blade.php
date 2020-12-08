@extends('layouts.app')
@section('content')
 <form id="formulario" method="post" action="{{URL::to('/noticias/crear')}}">
     @csrf
<div>titulo</div>
<input type="text" id="titulo" name="titulo">
<input type="text" id="texto" name="texto">
<input type="text" id="imagen" name="imagen">
<input type="text" id="autor_id" name="autor_id">
<input type="date" id="fecha" name="fecha">
<button type="submit">enviar</button>
</form>

@endsection