@extends('backend.base')

@section('postscript')
<script src="{{ url('assets/backend/js/script.js?r=' . uniqid()) }}"></script>
@endsection

@section('content')
<form id="formDelete" action="{{ url('backend/enterprise/' . $enterprise->id) }}" method="post">
    @method('delete')
    @csrf
</form>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                <a href="{{ url('backend/enterprise') }}" class="btn btn-primary">Enterprises</a>
                <a href="{{ url('backend/enterprise/create') }}" class="btn btn-primary">Create enterprise</a>
                <a href="#" data-table="enterprise" data-id="{{ $enterprise->id }}" data-name="{{ $enterprise->name }}" class="btn btn-danger" id="enlaceBorrar">Delete enterprise</a>
                <a href="{{ url('backend/enterprise/' . $enterprise->id . '/edit') }}" class="btn btn-primary">Edit enterprise</a>
                <a href="{{ url('backend/ticket/' . $enterprise->id . '/tickets') }}" class="btn btn-primary">View enterprise's tickets</a>
            </div>
        </div>
    </div>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Field</th>
            <th scope="col">Value</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Name</td>
            <td>{{$enterprise->name}}</td>
        </tr>
        <tr>
            <td>Phone number</td>
            <td>{{$enterprise->phone}}</td>
        </tr>
        <tr>
            <td>Contact Person</td>
            <td>{{$enterprise->contactperson}}</td>
        </tr>
        <tr>
            <td>Tax number</td>
            <td>{{$enterprise->taxnumber}}</td>
        </tr>
        <tr>
            <td>Address</td>
            <td>{{$enterprise->address}}</td>
        </tr>
    </tbody>
</table>
<img src="{{ url('logos/' . $logo) }}" width="100" alt="logo">  <!-- referenciando el archivo directamente -->
<img src="{{ url('logo/' . $logo) }}" width="100" alt="logo">   <!-- referenciando la ruta logo -->
<img src="{{ url('privada/3.png') }}" width="100" alt="privada"><!-- mostrando el archivo privado con la ruta privada -->
@endsection