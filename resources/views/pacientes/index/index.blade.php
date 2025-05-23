<x-app-layout>
    @section('contenido')


{{-- @if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif --}}
<div class="container">

    <div class="top-bar">
        <a href="{{ route('pacientes.create') }}" class="btn-nuevo">
         <span class="icon">+</span> Nuevo Paciente
        </a>
        <button class="btn-action btn-refresh" title="Recargar"></button>
        <button class="btn-action btn-search" title="Buscar"></button>
        <button class="btn-action btn-print" title="Imprimir"></button>

       </div>
       <div class="filters">

        <div class="filter-group">
         <input type="text" placeholder="Hist. Clínic..." />
         <button class="filter-search"></button>
        </div>
       </div>
       <div class="table-container">
        <div class="table-header">
         Visibilidad <a href="#">todos los pacientes</a> | 1 - 3 de 3
        </div>
        <table>
         <thead>
          <tr>
           <th></th>
           <th>Apellidos y Nombre</th>
           <th>Nacimiento</th>
           <th>Hist. Clín.</th>
           <th>Teléfono</th>
           <th>Móvil</th>
           <th>Dirección</th>

          </tr>
         </thead>
         <tbody>
            @foreach($pacientes as $key => $value)
                {{-- <tr>   { { route(paciente.edit,'id') }} --}}
                    <td><a class="edit-icon" href=""></a></td>
                    <@php
                        $nombre=$value->primer_apellido." ".$value->segundo_apellido." ".$value->nombre;
                    @endphp>

                    <td>{{ $nombre }}</td>
                    <td>{{ $value->fecha_nacimiento}}</td>
                    <td>{{ $value->historia}}</td>
                    <td>{{ $value->telefono_local}}</td>
                    <td>{{ $value->celular}}</td>
                     <td>{{ $value->direccion}}</td>


                    <td></td>
                </tr>
          @endforeach

         </tbody>
        </table>
       </div>


@endsection
</x-app-layout>
