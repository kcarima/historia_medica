<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reposo Médico</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .header { text-align: center; margin-bottom: 30px; }
        .title { font-size: 18px; font-weight: bold; text-decoration: underline; margin-bottom: 30px; }
        .content { margin: 20px 0; text-align: justify; }
        .signature { margin-top: 50px; text-align: center; }
        .footer { margin-top: 50px; font-size: 12px; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h2>INSTITUCIÓN DE SALUD</h2>
        <h3>CERTIFICADO DE REPOSO MÉDICO</h3>
    </div>

    <div class="content">
        <p>Yo, <strong>{{ $medico }}</strong>, médico certificado, hago constar que el/la paciente <strong>{{ $paciente }}</strong> requiere reposo médico desde el <strong>{{ $fechaInicio }}</strong> hasta el <strong>{{ $fechaFin }}</strong>, debido al siguiente diagnóstico:</p>

        <p style="margin-left: 30px; font-style: italic;">"{{ $diagnostico }}"</p>

        <p>Durante este período, el/la paciente debe abstenerse de realizar actividades laborales o académicas que puedan interferir con su recuperación.</p>
    </div>

    <div class="signature">
        <p>_________________________</p>
        <p>{{ $medico }}</p>
        <p>Médico Tratante</p>
        <p>CMP: 12345 (ejemplo)</p>
    </div>

    <div class="footer">
        <p>Emitido el: {{ $fecha }}</p>
        <p>Este documento es válido con la firma y sello del médico tratante</p>
    </div>
</body>
</html>
