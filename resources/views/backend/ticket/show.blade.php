@extends('backend.base')

@section('postscript')
<script src="{{ url('assets/backend/js/script.js?r=' . uniqid()) }}"></script>
@endsection

@section('content')
<form id="formDelete" action="{{ url('backend/ticket/' . $ticket->id) }}" method="post">
    @method('delete')
    @csrf
</form>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                <a href="{{ url('backend/ticket') }}" class="btn btn-primary">Tickets</a>
                <a href="{{ url('backend/ticket/create') }}" class="btn btn-primary">Create ticket</a>
                <a href="#" data-table="ticket" data-id="{{ $ticket->id }}" data-name="{{ $ticket->name }}" class="btn btn-danger" id="enlaceBorrar">Delete ticket</a>
                <a href="{{ url('backend/ticket/' . $ticket->id . '/edit') }}" class="btn btn-primary">Edit ticket</a>
                <a href="{{ url('backend/enterprise/' . $ticket->identerprise) }}" class="btn btn-primary">View ticket's enterprise</a>
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
        <label>Name</label>
        {{ $ticket->name }}
    </div>
    <div class="form-group">
        <label>Enterprise</label>
        {{ $ticket->enterprise->name . ' - ' . $ticket->enterprise->phone }}
    </div>
    <div class="form-group">
        <label>Price</label>
        {{ $ticket->price }}
    </div>
    <div class="form-group">
        <label>Initial date</label>
        {{ $ticket->initialdate }} (mysql)
    </div>
    <div class="form-group">
        <label>Final date</label>
        {{ date('d-m-Y', strtotime($ticket->finaldate)) }} (EU)
    </div>
    <div class="form-group">
        <label>Initial time</label>
        {{ $ticket->initialtime }}
    </div>
    <div class="form-group">
        <label>Final time</label>
        {{ $ticket->finaltime }}
    </div>
    <div class="form-group">
        <label>Description</label>
        {{ $ticket->description }}
    </div>
</div>
@endsection