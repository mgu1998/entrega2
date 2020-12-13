@extends('backend.base')

@section('postscript')
<script src="{{ url('assets/backend/js/script.js?r=' . uniqid()) }}"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                <a href="{{ url('backend/noticias') }}" class="btn btn-primary">Noticias backend</a>
                <a href="{{ url('backend/noticias/crear') }}" class="btn btn-primary">Crear noticia</a>
                <a href="{{ url('/noticias/') }}" class="btn btn-primary">Noticias</a>
            </div>
        </div>
    </div>
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
            Ticket created successfully 2: {{ Session::get('id') }}
        </div>
    </div>
</div>
@endif
--}}

<table class="table table-hover">
    <thead>
        <tr>
            <th>#id</th>
            <th>Titulo</th>
            <th>Texto</th>
            <th>Imagen</th>  
            <th>Autor</th>
            <th>Fecha</th>
            <th>Mostrar</th>
         
        </tr>
    </thead>
    <tbody>
    @foreach ($noticias as $noticia)
        <tr>
            <td>{{ $noticia->noticia_id }}</td>
            <td>{{ $noticia->titulo }}</td>
            <td>{{ $noticia->texto }}</td>
            <td><img src="{{ $noticia->imagen }}" width="50px" height="30px"></img></td>   
            <td><a href="{{ url('backend/noticias/autor/' . $noticia->autor_id) }}" >{!! $noticia['autor_id']!!}</a></td>
            <td>{{ $noticia->fecha }}</td>
            <td><a href="{{ url('backend/noticias/' . $noticia->noticia_id) }}">Ver</a></td>
         
            
        </tr>
    @endforeach
    </tbody>
</table>

@endsection