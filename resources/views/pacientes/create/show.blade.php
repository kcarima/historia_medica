@extends('layouts.app')

@section('content')
    <h1>Detalle del Paciente</h1>

    <p><strong>Primer Apellido:</strong> {{ $paciente->primer_apellido }}</p>
    <p><strong>Segundo Apellido:</strong> {{ $paciente->segundo_apellido }}</p>
    <p><strong>Nombre:</strong> {{ $paciente->nombre }}</p>
    <p><strong>Fecha de Nacimiento:</strong> {{ $paciente->fecha_nacimiento }}</p>
    <p><strong>Historia Clínica:</strong> {{ $paciente->historia }}</p>
    <p><strong>Teléfono Local:</strong> {{ $paciente->telefono_local }}</p>
    <p><strong>Celular:</strong> {{ $paciente->celular }}</p>
    <p><strong>Dirección:</strong> {{ $paciente->direccion }}</p>

    <a href="{{ route('pacientes.index') }}">Volver al listado</a>
@endsection
