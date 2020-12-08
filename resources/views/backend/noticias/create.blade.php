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
                <a href="{{ url('backend/noticias') }}" class="btn btn-primary">Noticias</a>
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
<form action="{{ url('backend/noticias/crear') }}" method="post" id="createNoticiaForm">
    @csrf
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">

    <div class="card-body">
        
        <div class="form-group">
        <label for="titulo">Titulo</label>
            <input type="text" id="titulo" name="titulo" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="texto">Texto</label>
            <textarea type="text" id="texto" name="texto" class="form-control" rows="5"></textarea>
            
        </div>
        
        <div class="form-group">
            <label for="imagen">Imagen</label>
            
            <input type="text" id="imagen" name="imagen" class="form-control">
            <small id="imagenHelp" class="form-text text-muted">La URL de la imagen.</small>
        </div>
        
        <div class="form-group">
            <label for="autor_id">Autor</label>
            <input type="text" id="autor_id" name="autor_id" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha" class="form-control">
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>
@endsection