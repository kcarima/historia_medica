<x-app-layout>

@section('contenido')


<head>
    <title>Registro de Historia Médica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/estilos_historia_medica.css') }}" rel="stylesheet">

</head>
<body>


        <h3 id="anamnesis">Anamnesis (Interrogatorio)</h3>
        <h4>Enfermedad Actual</h4>
        <div class="form-group">
            <label for="enfermedad_actual">Descripción:</label>
            <textarea id="enfermedad_actual" name="enfermedad_actual" rows="5"></textarea>
        </div>

</body>
@endsection
</x-app-layout>
