<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Solicitud de Imagenología</title>
    <style>
        @page {
            size: A5 portrait;
            margin: 1.5cm;
        }
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
            color: #333;
            line-height: 1.4;
        }
        .pdf-container {
            max-width: 100%;
            margin: 0 auto;
        }
        .header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #007bff;
        }
        .logo {
            height: 50px;
        }
        .titulo {
            font-size: 18px;
            font-weight: bold;
            color: #0056b3;
            margin-left: 15px;
            text-transform: uppercase;
        }
        .info-section {
            margin-bottom: 20px;
        }
        .section-title {
            font-weight: bold;
            color: #0056b3;
            margin-bottom: 8px;
            font-size: 13px;
        }
        .datos-paciente {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin-bottom: 20px;
        }
        .datos-paciente div {
            margin-bottom: 5px;
        }
        .estudios-solicitados ul {
            margin: 5px 0 0 0;
            padding-left: 20px;
        }
        .estudios-solicitados li {
            margin-bottom: 5px;
        }
        .observaciones {
            margin-top: 15px;
            padding-top: 10px;
            border-top: 1px dashed #ccc;
        }
        .firma-medico {
            margin-top: 40px;
            text-align: right;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }
        .nombre-medico {
            font-weight: bold;
            text-decoration: underline;
            color: #0056b3;
        }
        .fecha {
            text-align: right;
            margin-top: 5px;
            font-size: 11px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="pdf-container">
        <div class="header">
            <img src="{{ public_path('assets/img/clinica anfe.png') }}" alt="Logo" class="logo">
            <span class="titulo">Solicitud de Imagenología</span>
        </div>

        <div class="fecha">
            {{ now()->format('d/m/Y H:i') }}
        </div>

        <div class="info-section">
            <div class="section-title">Datos del Paciente</div>
            <div class="datos-paciente">
                <div><strong>Nombre completo:</strong> {{ $paciente->primer_apellido }} {{ $paciente->segundo_apellido ?? '' }} {{ $paciente->nombre }}</div>
                <div><strong>Cédula:</strong> {{ $paciente->cedula }}</div>
                <div><strong>Historia Clínica:</strong> {{ $paciente->historia }}</div>
                <div><strong>Edad:</strong> {{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->age }} años</div>
                <div><strong>Sexo:</strong> {{ $paciente->genero }}</div>
            </div>
        </div>

        <div class="info-section">
            <div class="section-title">Estudios Solicitados</div>
            <div class="estudios-solicitados">
                <ul>
                    @foreach($estudios as $estudio)
                        <li>{{ $estudio }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="info-section observaciones">
            <div class="section-title">Observaciones</div>
            <div>{{ $observaciones ?: 'Ninguna' }}</div>
        </div>

        @auth
        <div class="firma-medico">

            <div class="nombre-medico">Dr(a). {{ Auth::user()->name }}</div>
        </div>
        @endauth
    </div>
</body>
</html>
