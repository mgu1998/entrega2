@extends('backend.base')

@section('postscript')
<script src="{{ url('assets/backend/js/script.js?r=' . uniqid()) }}"></script>
@endsection

@section('content')

<form id="formDelete" action="{{ url('backend/noticias/' . $noticia->noticia_id) }}" method="post">
    @method('DELETE')
    @csrf
</form>


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                <a href="{{ url('backend/noticias') }}" class="btn btn-primary">Noticias</a>
                <a href="{{ url('backend/noticias/crear') }}" class="btn btn-primary">Crear Noticias</a>
                <a href="#" data-table="noticia" data-id="{{ $noticia->noticia_id }}" data-name="{{ $noticia->titulo }}" class="btn btn-danger" id="enlaceBorrar">Borrar noticia</a>

                
             </div>
        </div>
    </div>
</div>
@if(session()->has('error'))
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-danger" role="alert">
                <h2>Error ...</h2>
            </div>
        </div>
    </div>
@endif
<div class="card-body">
    <div class="form-group">
        <label>Titulo</label>
        {{ $noticia->titulo }}
    </div>
    <div class="form-group">
        <label>Texto</label>
        {{ $noticia->texto }}
    </div>
    <div class="form-group">
        <label>Imagen</label>
        <img src="{{ $noticia->imagen }}"></img>
    </div>
    <div class="form-group">
        <label>Fecha</label>
        {{ $noticia->fecha }} 
    </div>
    <div class="form-group">
        <label>Autor</label>
        <a href="{{ url('backend/noticias/autor/' . $noticia->autor_id) }}" >{!! $noticia['autor_id']!!}</a>
    </div>
    

    
    
   <form id="formulario" method="post" action="{{URL::to('/backend/comentarios/crear')}}">

        @csrf
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
       
      </div> 
    
    <div class="card-body">
        
<h2>Crear comentario</h2>
     <br/>
    <div class="form-group">
        <label>Tu comentario</label>
        <input type="text" id="texto" name="texto" class="form-control">

    </div>
    <br/>
    <div class="form-group">
        <label>Email</label>
        <input type="text" id="correo" name="correo" class="form-control">
    <br/>
    </div>
        <div class="form-group">
        <label>Fecha</label>
        <input type="date" id="fecha" name="fecha" class="form-control">

     <br/>
    </div>
        <input id="noticia_id" name="noticia_id" type="hidden" value="{!!$noticia['noticia_id']!!}">
        <button class="btn btn-primary"  type="submit">Enviar</button>
        <br></br>
        <h2>Comentarios</h2>
        </form>
        @foreach($comentarios as $comentario)
        <div class="card">
            <div class="card-body">
        <p>{!! $comentario['texto']!!}</p>
        <p>De: {!! $comentario['correo']!!}</p>
        <p>Fecha del comentario: {!! $comentario['fecha']!!}</p>
            </div>
        </div>
        <hr></hr>
        @endforeach
    </div>
@endsection