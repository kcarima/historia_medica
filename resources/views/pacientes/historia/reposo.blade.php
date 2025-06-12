<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reposo Médico - {{ $paciente->primer_apellido }} {{ $paciente->segundo_apellido ?? '' }}, {{ $paciente->nombre }}</title>
    <style>
        @page {
            size: letter;
            margin: 2cm 2cm 2cm 2cm;
        }
        body {
            font-family: 'Arial', sans-serif;
            font-size: 14px;
            color: #222;
            margin: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .clinic-name {
            font-size: 20px;
            font-weight: bold;
            color: #0066cc;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
            text-decoration: underline;
            margin: 25px 0 30px 0;
        }
        .patient-info {
            margin-bottom: 25px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            padding: 15px 20px;
            background: #f8fafd;
        }
        .patient-info-table {
            width: 100%;
            font-size: 14px;
        }
        .patient-info-table td {
            padding: 4px 8px;
        }
        .reposo-content {
            margin: 30px 0 40px 0;
            font-size: 15px;
            text-align: justify;
        }
        .diagnostico {
            margin: 15px 0 25px 30px;
            font-style: italic;
            font-size: 15px;
        }
        .signature {
            margin-top: 60px;
            text-align: right;
        }
        .signature-line {
            border-top: 1px solid #333;
            width: 250px;
            margin: 0 0 5px auto;
        }
        .footer {
            margin-top: 60px;
            font-size: 11px;
            text-align: center;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="clinic-name">CLÍNICA ANFE</div>
        <div class="title">CERTIFICADO DE REPOSO MÉDICO</div>
    </div>

    <div class="patient-info">
        <table class="patient-info-table">
            <tr>
                <td><strong>Paciente:</strong></td>
                <td>{{ $paciente->primer_apellido }} {{ $paciente->segundo_apellido ?? '' }}, {{ $paciente->nombre }}</td>
                <td><strong>Cédula:</strong></td>
                <td>{{ $paciente->cedula }}</td>
            </tr>
            <tr>
                <td><strong>Edad:</strong></td>
                <td>{{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->age }} años</td>
                <td><strong>Sexo:</strong></td>
                <td>{{ $paciente->sexo }}</td>
            </tr>
            <tr>
                <td><strong>Historia N°:</strong></td>
                <td>{{ $paciente->historia }}</td>
                <td><strong>Fecha:</strong></td>
                <td>{{ $fecha }}</td>
            </tr>
        </table>
    </div>

    <div class="reposo-content">
        <p>Quien suscribe, Dr(a). <strong>{{ $medico }}</strong>, certifica que el(la) paciente antes identificado(a) requiere <strong>reposo médico</strong> desde el
            <strong>{{ \Carbon\Carbon::parse($historia->fecha_reposo_desde)->format('d/m/Y') }}</strong> hasta el
            <strong>{{ \Carbon\Carbon::parse($historia->fecha_reposo_hasta)->format('d/m/Y') }}</strong> por el siguiente diagnóstico:</p>
        <div class="diagnostico">"{{ $historia->diagnostico }}"</div>
        <p>Durante este período, el(la) paciente debe abstenerse de realizar actividades laborales, académicas o físicas que puedan interferir con su recuperación.</p>
    </div>

    <div class="signature">
        <div class="signature-line"></div>
        <div>Dr(a). {{ $medico }}</div>
           </div>

    <div class="footer">
        Este certificado es válido solo con la firma y sello del médico tratante.<br>
        Emitido en Ciudad Guayana, el {{ $fecha }}
    </div>
</body>
</html>
