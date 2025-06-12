<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe Médico - {{ $paciente->primer_apellido }} {{ $paciente->segundo_apellido ?? '' }}, {{ $paciente->nombre }}</title>
    <style>
        @page {
            size: A4;
            margin: 2cm 1.5cm 2cm 1.5cm;
            @top-center {
                content: element(header);
            }
            @bottom-center {
                content: element(footer);
            }
        }

        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.5;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }

        /* Header */
        .header {
            position: running(header);
            text-align: center;
            margin-bottom: 1.5cm;
            border-bottom: 2px solid #0056b3;
            padding-bottom: 10px;
        }

        .clinic-name {
            font-family: 'Georgia', serif;
            font-size: 14pt;
            font-weight: bold;
            color: #0056b3;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .clinic-info {
            font-size: 9pt;
            color: #666;
            margin-top: 2px;
        }

        .title {
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
            margin: 15px 0;
            letter-spacing: 1px;
            color: #0056b3;
        }

        /* Patient Info */
        .patient-info {
            margin-bottom: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            padding: 10px 12px;
            background: #f8fafd;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .patient-info-table {
            width: 100%;
            font-size: 10pt;
            border-collapse: collapse;
        }

        .patient-info-table td {
            padding: 6px 8px;
            border-bottom: 1px solid #eaeaea;
        }

        .patient-info-table tr:last-child td {
            border-bottom: none;
        }

        /* Content Sections */
        .informe-content {
            margin: 20px 0;
        }

        .section-title {
            font-weight: 600;
            color: #0056b3;
            margin-top: 12px;
            margin-bottom: 6px;
            font-size: 10.5pt;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #eaeaea;
            padding-bottom: 3px;
        }

        .section-content {
            margin-bottom: 8px;
            text-align: justify;
            padding-left: 5px;
        }

        /* Signature Section */
        .signature-section {
            margin-top: 40px;
            text-align: right;
        }

        .signature-box {
            display: inline-block;
            text-align: center;
            border-top: 1px solid #333;
            width: 250px;
            padding-top: 5px;
            font-size: 9pt;
        }

        /* Stamp Area */
        .stamp-area {
            margin-top: 15px;
            height: 50px;
            position: relative;
        }

        .stamp-placeholder {
            position: absolute;
            left: 0;
            width: 80px;
            height: 40px;
            border: 1px dashed #999;
            text-align: center;
            line-height: 40px;
            color: #999;
            font-size: 8pt;
            border-radius: 3px;
        }

        /* Footer */
        .footer {
            position: running(footer);
            margin-top: 20px;
            font-size: 8pt;
            text-align: center;
            color: #777;
            border-top: 1px solid #eaeaea;
            padding-top: 5px;
            width: 100%;
        }

        /* Watermark */
        .watermark {
            position: fixed;
            opacity: 0.08;
            font-size: 60pt;
            width: 100%;
            text-align: center;
            top: 40%;
            transform: rotate(-30deg);
            z-index: -1;
            color: #0056b3;
            font-family: 'Georgia', serif;
            font-weight: bold;
            pointer-events: none;
            user-select: none;
        }

        /* Data Highlights */
        .data-highlight {
            font-weight: 600;
            color: #0056b3;
        }

        /* Responsive adjustments for print */
        @media print {
            body {
                padding-top: 2cm;
                padding-bottom: 2cm;
            }

            .no-print {
                display: none !important;
            }

            .page-break {
                page-break-after: always;
            }
        }
    </style>
</head>
<body>
    <div class="watermark">CLÍNICA ANFE</div>

    <div class="header">
        <div class="clinic-name">CLÍNICA ANFE</div>
        <div class="clinic-info">RIF: J-12345678-9 • Av. Principal, Ciudad Guayana • Tel: (0286) 123-4567</div>
        <div class="title">Informe Médico</div>
    </div>

    <div class="patient-info">
        <table class="patient-info-table">
            <tr>
                <td width="15%"><strong>Paciente:</strong></td>
                <td width="35%">{{ $paciente->primer_apellido }} {{ $paciente->segundo_apellido ?? '' }}, {{ $paciente->nombre }}</td>
                <td width="15%"><strong>Cédula:</strong></td>
                <td width="35%">{{ $paciente->cedula }}</td>
            </tr>
            <tr>
                <td><strong>Edad:</strong></td>
                <td>{{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->age }} años</td>
                <td><strong>Sexo:</strong></td>
                <td>{{ $paciente->sexo }}</td>
            </tr>
            <tr>
                <td><strong>Historia Clínica:</strong></td>
                <td>{{ $paciente->historia }}</td>
                <td><strong>Fecha:</strong></td>
                <td>{{ $fecha }}</td>
            </tr>
        </table>
    </div>

    <div class="informe-content">
        <div class="section-title">Motivo de Consulta</div>
        <div class="section-content">{{ $motivo_resumido }}</div>

        <div class="section-title">Hallazgos Clínicos</div>
        <div class="section-content">{{ $hallazgos_clinicos ?? 'Sin hallazgos relevantes registrados.' }}</div>

        <div class="section-title">Diagnóstico</div>
        <div class="section-content">
            <span class="data-highlight">{{ $diagnostico }}</span>
        </div>

        <div class="section-title">Recomendaciones</div>
        <div class="section-content">{{ $recomendaciones ?? 'No se registraron recomendaciones específicas.' }}</div>

        <div class="section-title">Examen Físico</div>
        <div class="section-content">
            @if(!empty($fisico->presion_arterial))<strong class="data-highlight">Presión Arterial:</strong> {{ $fisico->presion_arterial }}<br>@endif
            @if(!empty($fisico->frecuencia_cardiaca))<strong class="data-highlight">Frecuencia Cardíaca:</strong> {{ $fisico->frecuencia_cardiaca }} lpm<br>@endif
            @if(!empty($fisico->frecuencia_respiratoria))<strong class="data-highlight">Frecuencia Respiratoria:</strong> {{ $fisico->frecuencia_respiratoria }} rpm<br>@endif
            @if(!empty($fisico->temperatura))<strong class="data-highlight">Temperatura:</strong> {{ $fisico->temperatura }} °C<br>@endif
            @if(!empty($fisico->saturacion_oxigeno))<strong class="data-highlight">Saturación de Oxígeno:</strong> {{ $fisico->saturacion_oxigeno }} %<br>@endif
            @if(!empty($fisico->peso))<strong class="data-highlight">Peso:</strong> {{ $fisico->peso }} kg<br>@endif
            @if(!empty($fisico->talla))<strong class="data-highlight">Talla:</strong> {{ $fisico->talla }} cm<br>@endif
            @if(!empty($fisico->examen_general))<strong class="data-highlight">Examen General:</strong> {{ $fisico->examen_general }}<br>@endif
            @if(!empty($fisico->examen_por_sistemas))<strong class="data-highlight">Exploración Física por Sistemas:</strong> {{ $fisico->examen_por_sistemas }}@endif
        </div>
    </div>



    <div class="signature-section">
        <div class="signature-box">
            Dr(a). {{ $medico }}<br>
            @if(!empty($cmp))<span class="data-highlight">CMP:</span> {{ $cmp }}@endif
            @if(!empty($especialidad))<br><span class="data-highlight">Especialidad:</span> {{ $especialidad }}@endif
        </div>
    </div>

    <div class="footer">
        Documento emitido electrónicamente por Clínica ANFE • {{ $fecha }} • Ciudad Guayana, Estado Bolívar, Venezuela<br>
        Este documento es válido solo con la firma y sello del médico tratante
    </div>
</body>
</html>
