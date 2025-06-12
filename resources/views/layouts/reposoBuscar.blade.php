@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Buscar Paciente</h2>

    <form action="{{ route('pacientes.buscarResultado') }}" method="GET">
        <div class="form-group">
            <label for="busqueda">Número de Cédula o Historia Clínica</label>
            <input type="text" name="busqueda" id="busqueda" class="form-control" placeholder="Ingrese cédula o historia" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Buscar</button>
    </form>
</div>
@endsection
