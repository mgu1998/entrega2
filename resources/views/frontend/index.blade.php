@extends('frontend.app')

@section('postscript')
<script src="{{ url('assets/backend/js/script.js?r=' . uniqid()) }}"></script>
@endsection

@section('content')


<div class="container">
    
    
    <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ url('backend/noticias/crear') }}" class="btn btn-primary">Crear noticia</a>
            </div>
        </div>
    </div>
    </div>
    
        @foreach($noticias as $noticia)
        <div class="row">
      <div class=col>
        <div class="card mt-4 pt-4">
          <img src="{{ $noticia->imagen }}" class="card-img-top" alt="...">
          <div class="card-body">
                <h5 class="card-title">{{ $noticia->titulo }}</h5>
                <p class="card-text">{{ $noticia->texto }}</p>
          </div>
          <div class="card-body">
                <a href="{{ url('/noticias/' . $noticia->noticia_id) }}" class="card-link">Ver mas</a>
                <a href="{{ url('/noticias/' . $noticia->noticia_id .'#comentario') }}" class="card-link">Leer comentarios</a>
                <a href="{{ url('/noticias/autor/' . $noticia->autor_id) }}" class="card-link">Mas del autor</a>

          </div>
        </div>
          
      </div>
     
    </div>
           @endforeach 
   
    
    
    
    </div>
    



<!--
op -> store, update, destroy
r -> negativo, 0, positivo (acierto)
id -> id del elemento afectado
-->

@if(session()->has('op'))
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-success" role="alert">
            Operation: {{ session()->get('op') }}. Id: {{ session()->get('id') }}. Result: {{ session()->get('r') }}
        </div>
    </div>
</div>
@endif

{{--
@if(Session::get('op') !== null)
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-success" role="alert">
            Noticia created successfully 2: {{ Session::get('id') }}
        </div>
    </div>
</div>
@endif
--}}
</div>
@endsection