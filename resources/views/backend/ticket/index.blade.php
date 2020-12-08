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
                <a href="{{ url('backend/ticket') }}" class="btn btn-primary">Tickets</a>
                <a href="{{ url('backend/ticket/create') }}" class="btn btn-primary">Create ticket</a>
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
            <th>name</th>
            <th>enterprise</th>
            <th>price</th>
            <th>initial date (EU)</th>
            <th>final date (GB/USA)</th>
            <th>active</th>
            
            <th>show</th>
            <th>edit</th>
            <th>delete</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($tickets as $ticket)
        <tr>
            <td>{{ $ticket->id }}</td>
            <td>{{ $ticket->name }}</td>
            <td>
                <a href="{{ url('backend/enterprise/' . $ticket->identerprise) }}">{{ $ticket->enterprise->name }}</a>
                (<a href="{{ url('backend/ticket/' . $ticket->identerprise . '/tickets') }}">tickets</a>)
            </td>
            <td>{{ $ticket->price }}</td>
            <td>{{ date('d-m-Y', strtotime($ticket->initialdate)) }}</td>
            <td>{{ date('m-d-Y', strtotime($ticket->finaldate)) }}</td>
            <td>
            @if($ticket->active)
                &#x2714; <!--&check;-->
            @else
                &#10060;
            @endif
            </td>
            <td><a href="{{ url('backend/ticket/' . $ticket->id) }}">show</a></td>
            <td><a href="{{ url('backend/ticket/' . $ticket->id . '/edit') }}">edit</a></td>
            <td><a href="#" data-table="ticket" data-id="{{ $ticket->id }}" class="enlaceBorrar" >delete</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
<form id="formDelete" action="{{ url('backend/ticket') }}" method="post">
    @method('delete')
    @csrf
</form>
@endsection