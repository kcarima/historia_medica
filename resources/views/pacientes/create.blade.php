@extends('layouts.app')

@section('title', 'Crear un cliente')

@section('content')
<!-- if there are creation errors, they will show here -->
{{ Html::ul($errors->all()) }}
<div class="jumbotron w-100 mx-auto border shadow-lg p-4 mb-4 bg-white">
    <div class="jumbotron h-25 d-flex justify-content-center"><h1>Creación de clientes</h1></div>
    {{ Form::open(array('url' => 'Paciente')) }}
    <div class="form-group">
        {{ Form::label('nombre', 'Nombre del paciente') }}
        {{ Form::text('nombre', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('ci', 'Cédula de Identidad:') }}
        {{ Form::text('ci', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('nacionalidad', 'Nacionalidad') }}
        {{ Form::text('nacionalidad', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('direccion', 'Dirección') }}
        {{ Form::text('direccion', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('provincia', 'Provincia') }}
        {{ Form::select('provincias', $provincias->pluck('region_name', 'id'), null, array('class' => 'form-control',  'placeholder' => 'Selecciona una provincia...')) }}
    </div>

    <div class="form-group">
        {{ Form::label('municipio', 'Municipio') }}
        {{ Form::select('municipios', $municipios->pluck('city_name', 'id'), null, array('class' => 'form-control',  'placeholder' => 'Selecciona un municipio...')) }}
    </div>

    <div class="form-group">
        {{ Form::label('fechainiciocontrato', 'Fecha inicio de contrato') }}
        {{ Form::date('fechainiciocontrato', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('fechafincontrato', 'Fecha fin de contrato') }}
        {{ Form::date('fechafincontrato', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('numeroreconocimientoscontratados', 'Reconocimientos a contratar') }}
        {{ Form::number('numeroreconocimientoscontratados', null, array('class' => 'form-control')) }}
    </div>


    <div class="d-flex justify-content-center">
        {{ Form::submit('Crear', array('class' => 'btn btn-primary')) }}
    </div>
    {{ Form::close() }}

</div>
</div>
@endsection