<x-app-layout>

@section('contenido')

<head>

    <title>Nota Operatoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/nota_operatoria.css') }}" rel="stylesheet">
</head>
<body>
    <div class="contenedor-nota">
        <h2>Nota operatoria</h2>
        <form action="guardar_nota.php" method="POST">
            <textarea name="nota" class="campo-nota" required placeholder="Escribe la nota operatoria..."></textarea>
            <button type="submit" class="btn-guardar">Guardar</button>
        </form>
    </div>
</body>
</html>
@endsection
</x-app-layout>
