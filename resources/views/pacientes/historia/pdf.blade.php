<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Historia Clínica - {{ $paciente->primer_apellido }} {{ $paciente->segundo_apellido ?? '' }}, {{ $paciente->nombre }}</title>
    <style>
        @page {
            size: letter;
            margin: 1.5cm 2cm 2.5cm 2cm;
        }
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            position: relative;
            margin: 0;
            padding-bottom: 2cm;
        }
        .header {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #0066cc;
        }
        .logo-container {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }
        .logo {
            height: 20px;
            max-width: 150px;
        }
        .clinic-info {
            flex-grow: 1;
            text-align: left;
        }
        .clinic-name {
            font-size: 18px;
            font-weight: bold;
            color: #0066cc;
            margin-bottom: 5px;
        }
        .document-info {
            text-align: right;
            min-width: 150px;
        }
        .patient-header {
            background-color: #f0f8ff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .patient-name {
            font-size: 16px;
            font-weight: bold;
        }
        .patient-details {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 10px;
            margin-top: 10px;
        }
        .patient-detail-item {
            display: flex;
        }
        .patient-detail-item:empty {
            display: none;
        }
        .document-title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin: 15px 0;
            color: #0066cc;
        }
        .section {
            margin-bottom: 15px;
            page-break-inside: avoid;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            padding: 10px;
            background-color: #fafafa;
        }
        .section-empty {
            display: none;
        }
        .section-title {
            font-weight: bold;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
            margin-bottom: 10px;
            color: #0066cc;
            font-size: 13px;
        }
        .section-content {
            padding: 5px;
            white-space: pre-line;
            min-height: 20px;
            font-size: 12px;
        }
        .section-content:empty {
            display: none;
        }
        .section-content:empty + .section-title {
            display: none;
        }
        .two-columns {
            display: flex;
            gap: 20px;
            margin-top: 15px;
        }
        .column {
            flex: 1;
        }
        .signature-area {
            margin-top: 40px;
            text-align: right;
            padding-right: 50px;
        }
        .signature-line {
            border-top: 1px solid #333;
            display: inline-block;
            width: 250px;
            margin-bottom: 5px;
        }
        .footer {
            position: fixed;
            bottom: 1cm;
            left: 2cm;
            right: 2cm;
            height: auto;
            background-color: white;
            padding: 5px 0;
            font-size: 9px;
            text-align: center;
            border-top: 1px solid #eee;
        }
        .footer-content {
            line-height: 1.3;
        }
        .page-break {
            page-break-after: always;
        }
        .print-btn-container {
            text-align: center;
            margin: 20px 0;
        }
        .print-btn {
            background: #0066cc;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                font-size: 11px;
                padding-bottom: 1.5cm;
            }
            .footer {
                bottom: 0.5cm;
            }
            .section {
                background-color: transparent;
                border: none;
                padding: 5px 0;
            }
            .section-title {
                border-bottom: 1px solid #eee;
            }
        }
    </style>
</head>
<body>
    <!-- Encabezado -->
    <div class="header">
        <div class="logo-container">
            @php
                $logoPath = 'assets/img/logo.png';
                $logoFullPath = public_path($logoPath);
                $logoExists = file_exists($logoFullPath);
            @endphp

            @if($logoExists)
                <img src="{{ $logoFullPath }}" class="logo" alt="Logo Clínica">
            @endif
        </div>

        <div class="clinic-info">
            <div class="clinic-name">CLÍNICA ANFE</div>

        </div>

        <div class="document-info">
            <div><strong>Historia N°:</strong> {{ $paciente->historia }}</div>
            <div><strong>Fecha:</strong> {{ $fecha }}</div>
            <div><strong>Página 1 de {{ !empty($historia->observaciones) && strlen($historia->observaciones) > 500 ? '2' : '1' }}</div>
        </div>
    </div>

    <!-- Datos del paciente -->
    <div class="patient-header">
    <div class="patient-name">
        {{ $paciente->primer_apellido }} {{ $paciente->segundo_apellido ?? '' }}, {{ $paciente->nombre }}
    </div>
    <div class="patient-details">

        @if(!empty($paciente->cedula))
            <div class="patient-detail-item"><strong>Cédula:</strong> {{ $paciente->cedula }}</div>
        @endif

        @if(!empty($paciente->fecha_nacimiento))
            <div class="patient-detail-item">
                <strong>Edad:</strong> {{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->age }} años
            </div>
        @endif

        @if(!empty($paciente->sexo))
            <div class="patient-detail-item"><strong>Sexo:</strong> {{ $paciente->sexo }}</div>
        @endif

        @if(!empty($paciente->telefono))
            <div class="patient-detail-item"><strong>Teléfono:</strong> {{ $paciente->telefono }}</div>
        @endif

        @if(!empty($paciente->email))
            <div class="patient-detail-item"><strong>Email:</strong> {{ $paciente->email }}</div>
        @endif

    </div>
</div>


    <!-- Título del documento -->
    <div class="document-title">HISTORIA CLÍNICA</div>

   <!-- Contenido principal de la historia clínica -->
<div class="two-columns">
    <div class="column">
        <!-- Motivo de consulta -->
        @if(!empty($historia->motivo_consulta))
        <div class="section">
            <div class="section-title">MOTIVO DE CONSULTA</div>
            <div class="section-content">{{ $historia->motivo_consulta }}</div>
        </div>
        @endif
              <!-- Diagnostico -->
        @if(!empty($historia->diagnostico))
        <div class="section">
            <div class="section-title">DIAGNOSTICO</div>
            <div class="section-content">{{ $historia->diagnostico }}</div>
        </div>
        @endif

        <!-- Enfermedad actual -->
        @if(!empty($historia->enfermedad_actual))
        <div class="section">
            <div class="section-title">ENFERMEDAD ACTUAL</div>
            <div class="section-content">{{ $historia->enfermedad_actual }}</div>
        </div>
        @endif

        <!-- Antecedentes personales -->
        @if(!empty($historia->antecedentes_personales))
        <div class="section">
            <div class="section-title">ANTECEDENTES PERSONALES</div>
            <div class="section-content">{{ $historia->antecedentes_personales }}</div>
        </div>
        @endif

        <!-- Antecedentes familiares -->
        @if(!empty($historia->antecedentes_familiares))
        <div class="section">
            <div class="section-title">ANTECEDENTES FAMILIARES</div>
            <div class="section-content">{{ $historia->antecedentes_familiares }}</div>
        </div>
        @endif

        <!-- Hábitos -->
        @if(!empty($historia->habitos))
        <div class="section">
            <div class="section-title">HÁBITOS</div>
            <div class="section-content">
                @php
                    $habitos = json_decode($historia->habitos, true);
                @endphp

                @if(!empty($habitos))
                    @if(!empty($habitos['alcohol']))<div><strong>Alcohol:</strong> {{ $habitos['alcohol'] }}</div>@endif
                    @if(!empty($habitos['tabaco']))<div><strong>Tabaco:</strong> {{ $habitos['tabaco'] }}</div>@endif
                    @if(!empty($habitos['drogas']))<div><strong>Drogas:</strong> {{ $habitos['drogas'] }}</div>@endif
                    @if(!empty($habitos['ejercicio']))<div><strong>Ejercicio:</strong> {{ $habitos['ejercicio'] }}</div>@endif
                    @if(!empty($habitos['alimentacion']))<div><strong>Alimentación:</strong> {{ $habitos['alimentacion'] }}</div>@endif
                    @if(!empty($habitos['otros']))<div><strong>Otros:</strong> {{ $habitos['otros'] }}</div>@endif
                @endif
            </div>
        </div>
        @endif
    </div>

    <div class="column">
        <!-- Revisión por sistemas -->
        @if(!empty($historia->revision_sistemas))
        <div class="section">
            <div class="section-title">REVISIÓN POR SISTEMAS</div>
            <div class="section-content">{{ $historia->revision_sistemas }}</div>
        </div>
        @endif

        <!-- Examen físico -->
        @if(!empty($historia->examen_fisico))
        <div class="section">
            <div class="section-title">EXAMEN FÍSICO</div>
            <div class="section-content">{{ $historia->examen_fisico }}</div>
        </div>
        @endif

        <!-- Signos vitales -->
        @if(!empty($historia->signos_vitales))
        <div class="section">
            <div class="section-title">SIGNOS VITALES</div>
            <div class="section-content">
                @php
                    $signos = json_decode($historia->signos_vitales, true);
                @endphp

                @if(!empty($signos))
                    <div><strong>T.A.:</strong> {{ $signos['ta'] ?? '' }}</div>
                    <div><strong>FC:</strong> {{ $signos['fc'] ?? '' }}</div>
                    <div><strong>FR:</strong> {{ $signos['fr'] ?? '' }}</div>
                    <div><strong>Temp:</strong> {{ $signos['temp'] ?? '' }}</div>
                    <div><strong>Peso:</strong> {{ $signos['peso'] ?? '' }}</div>
                    <div><strong>Talla:</strong> {{ $signos['talla'] ?? '' }}</div>
                    <div><strong>IMC:</strong> {{ $signos['imc'] ?? '' }}</div>
                    @if(!empty($signos['otros']))<div><strong>Otros:</strong> {{ $signos['otros'] }}</div>@endif
                @endif
            </div>
        </div>
        @endif

        <!-- Alergias -->
        @if(!empty($historia->alergias))
        <div class="section">
            <div class="section-title">ALERGIAS</div>
            <div class="section-content">{{ $historia->alergias }}</div>
        </div>
        @endif
    </div>
</div>

<!-- Diagnósticos -->
@if(!empty($historia->diagnosticos))
<div class="section">
    <div class="section-title">DIAGNÓSTICOS</div>
    <div class="section-content">
        @php
            $diagnosticos = json_decode($historia->diagnosticos, true);
        @endphp

        @if(!empty($diagnosticos))
            @foreach($diagnosticos as $dx)
                <div>{{ $loop->iteration }}. {{ $dx['diagnostico'] ?? '' }}
                    @if(!empty($dx['tipo'])) ({{ $dx['tipo'] }}) @endif
                    @if(!empty($dx['codigo_icd'])) [{{ $dx['codigo_icd'] }}] @endif
                </div>
            @endforeach
        @endif
    </div>
</div>
@endif

<!-- Tratamiento y plan -->
<div class="two-columns">
    <div class="column">
        @if(!empty($historia->tratamiento_farmacologico))
        <div class="section">
            <div class="section-title">TRATAMIENTO FARMACOLÓGICO</div>
            <div class="section-content">{{ $historia->tratamiento_farmacologico }}</div>
        </div>
        @endif

        @if(!empty($historia->indicaciones))
        <div class="section">
            <div class="section-title">INDICACIONES</div>
            <div class="section-content">{{ $historia->indicaciones }}</div>
        </div>
        @endif
    </div>
    <div class="column">
        @if(!empty($historia->plan_tratamiento))
        <div class="section">
            <div class="section-title">PLAN DE TRATAMIENTO</div>
            <div class="section-content">{{ $historia->plan_tratamiento }}</div>
        </div>
        @endif

        @if(!empty($historia->recomendaciones))
        <div class="section">
            <div class="section-title">RECOMENDACIONES</div>
            <div class="section-content">{{ $historia->recomendaciones }}</div>
        </div>
        @endif
    </div>
</div>

<!-- Exámenes complementarios -->
@if(!empty($historia->ordenes_examenes))
<div class="section">
    <div class="section-title">EXÁMENES COMPLEMENTARIOS</div>
    <div class="section-content">{{ $historia->ordenes_examenes }}</div>
</div>
@endif

<!-- Observaciones adicionales -->
@if(!empty($historia->observaciones))
<div class="section">
    <div class="section-title">OBSERVACIONES ADICIONALES</div>
    <div class="section-content">{{ $historia->observaciones }}</div>
</div>
@endif

    <!-- Página adicional si es necesario -->
    @if(!empty($historia->observaciones) && strlen($historia->observaciones) > 500)
    <div class="page-break"></div>

    <!-- Encabezado página 2 -->
    <div class="header">
        <div class="logo-container">
            @if($logoExists)
                <img src="{{ $logoFullPath }}" class="logo" alt="Logo Clínica">
            @endif
        </div>
        <div class="clinic-info">
            <div class="clinic-name">CLÍNICA ANFE</div>
            <div>Continuación Historia Clínica</div>
        </div>
        <div class="document-info">
            <div><strong>Paciente:</strong> {{ $paciente->primer_apellido }} {{ $paciente->segundo_apellido ?? '' }}, {{ $paciente->nombre }}</div>
            <div><strong>Historia N°:</strong> {{ $paciente->historia }}</div>
            <div><strong>Página 2 de 2</div>
        </div>
    </div>
    @endif



    <!-- Firma -->
    <div class="signature-area">
        <div class="signature-line"></div>
        <div>Dr(a). {{ Auth::user()->name }}</div>
        @if(!empty(Auth::user()->crm))
        <div>CRM: {{ Auth::user()->crm }}</div>
        @endif
        @if(!empty(Auth::user()->especialidad))
        <div>Especialidad: {{ Auth::user()->especialidad }}</div>
        @endif
    </div>



    <!-- Pie de página -->
    <div class="footer">
        <div class="footer-content">
            CALLE ECUADOR MANZANA 57 CASA 12 SECTOR CAMPO B DE FERROMINERA. PUERTO ORDAZ-CIUDAD GUAYANA. EDO. BOLIVAR.<br>
            TELEFONO: 0424-9618673 | E-MAIL: clinicaanfe@gmail.com | INSTAGRAM: Clinicaanfe
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Asegurar que los saltos de línea se mantengan
            document.querySelectorAll('.section-content').forEach(content => {
                if(content.textContent.trim() !== '') {
                    content.innerHTML = content.textContent.replace(/\n/g, '<br>');
                }
            });
        });
    </script>
</body>
</html>
