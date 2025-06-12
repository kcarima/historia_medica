<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Solicitud de Laboratorio</title>
    <style>
        @page { size: A5 landscape; margin: 0; }
        body {
            background: #e9eef6;
            font-family: Arial, 'Segoe UI', Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 10px;
        }
        .pdf-container {
            padding: 32px 28px 32px 28px;
            max-width: 540px;
            margin: 24px auto;
            display: flex;
            flex-direction: column;
            gap: 16px;
            position: relative;
            /* background: #fff; */
            border-radius: 12px;
            /* box-shadow: 0 4px 24px 0 rgba(44,62,80,0.10); */
            border: 1px solid #dbeafe;
        }
        .contenido-derecha {
            position: absolute;
            top: 0;
            left: 52%;
            width: 48%;
            height: 100%;
            padding-left: 12px;
            box-sizing: border-box;
            z-index: 2;
            display: flex;
            flex-direction: column;
            font-size: 10px;
            align-items: flex-start;
        }
        .linea-divisoria {
            display: block;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 52%;
            width: 0;
            border-left: 1.5px dashed #b0b0b0;
            z-index: 1;
        }
        .header {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: flex-start;
            border-bottom: 2px solid #007bff;
            padding-bottom: 6px;
            margin-bottom: 10px;
            /* background: #f1f5fa; */
            border-radius: 10px 10px 0 0;
        }
        .logo-col {
            flex: 0 0 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .info-col {
            flex: 1 1 auto;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            padding-left: 12px;
        }
        .logo-clinica {
            width: 54px;
            height: 54px;
            object-fit: contain;
            margin-right: 0;
            border-radius: 8px;
            border: 1px solid #e0e7ef;
            /* background: #fff; */
        }
        .nombre-clinica {
            font-size: 10px;
            font-weight: 700;
            color: #044cdc;
            margin-bottom: 0;
            white-space: nowrap;
            letter-spacing: 1px;
        }
        .info-clinica-extra {
            font-size: 8px;
            color: #444;
            margin-top: 2px;
            white-space: nowrap;
        }
        .fecha {
            font-size: 9px !important;
            color: #007bff;
            font-weight: 600;
        }
        .titulo-lab {
            font-size: 13px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 8px;
            letter-spacing: 1.5px;
            color: #219150;
            /* background: #e0f7ef; */
            /* border-radius: 6px; */
            /* padding: 4px 0; */
            border-bottom: 2px solid #219150;
            /* box-shadow: 0 2px 8px 0 #c2f2da; */
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 2px;
        }
        td.label {
            color: #2563eb;
            font-weight: 600;
            padding-right: 4px;
            width: 38%;
        }
        td.value {
            color: #222;
            font-weight: 400;
            /* background: #f6faff; */
            border-radius: 4px;
            padding: 2px 6px;
        }
        .section-title {
            color: #219150;
            font-size: 10px;
            font-weight: 700;
            margin-top: 12px;
            margin-bottom: 8px;
            border-bottom: 1.2px solid #219150;
            padding-bottom: 2px;
            letter-spacing: 0.5px;
        }
        .lab-list {
            columns: 2 120px;
            -webkit-columns: 2 120px;
            -moz-columns: 2 120px;
            gap: 0;
            margin-bottom: 8px;
        }
        .lab-item {
            display: flex;
            align-items: center;
            margin-bottom: 4px;
            font-size: 10px;
            color: #222;
            /* background: #f1f5fa; */
            border-radius: 4px;
            padding: 2px 6px;
            margin-right: 4px;
        }
        .otros-text {
            width: 100%;
            min-height: 30px;
            border-radius: 5px;
            border: none;
            font-size: 10px;
            padding: 5px 8px;
            margin-top: 4px;
            color: #444;
            /* background: #f6faff; */
            box-sizing: border-box;
        }
        .medico {
            margin-top: 10px;
            text-align: right;
            font-size: 10px;
            color: #007bff;
            font-weight: 700;
            line-height: 1.05;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
        .medico-name {
            margin-top: 0.5px;
            border-top: 1px solid #007bff;
            width: auto;
            margin-left: 8px;
            padding-top: 1px;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0;
            line-height: 1;
            display: inline-block;
            border-width: 0 0 1px 0;
        }
        @media (max-width: 700px) {
            .pdf-container {
                max-width: 98vw;
                padding: 18px 6vw;
            }
            .lab-list {
                columns: 1 150px;
            }
        }
        body, .header h2, .header .fecha, table, td, .label, .value, .section-title, .lab-list label, .lab-item, .otros-text, .medico, .medico-name {
            font-size: 10px !important;
            font-family: Arial, 'Segoe UI', Helvetica, sans-serif !important;
        }
    </style>
</head>
<body>
    <div class="pdf-container">
        <div class="linea-divisoria"></div>
        <div class="contenido-derecha">
            <div class="header" style="border-bottom: 2px solid #007bff; padding-bottom: 4px; margin-bottom: 8px;">
                <table style="width:100%; border:none;">
                    <tr>
                        <td style="width:60px; vertical-align:top; border:none; padding:0;">
                            <img src="{{ public_path('assets/img/clinica anfe.png') }}" alt="Logo Clínica" class="logo-clinica">
                        </td>
                        <td style="vertical-align:top; border:none; padding-left:12px;">
                            <div class="nombre-clinica">Clínica ANFE</div>
                            <div class="info-clinica-extra">Av. Principal 123, Ciudad - Tel: 0000-000000</div>
                        </td>
                        <td style="text-align:right; vertical-align:top; border:none; padding-left:12px; white-space:nowrap;">
                            <div class="fecha">Fecha: {{ date('d/m/Y') }}</div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="titulo-lab">
                SOLICITUD DE LABORATORIOS
            </div>
            <table>
                <tr>
                    <td class="label">Cédula:</td>
                    <td class="value">{{ $cedula ?? '' }}</td>
                </tr>
                <tr>
                    <td class="label">Historia Clínica:</td>
                    <td class="value">{{ $historia ?? '' }}</td>
                </tr>
                <tr>
                    <td class="label">Nombre:</td>
                    <td class="value">{{ $nombre ?? '' }}</td>
                </tr>
                <tr>
                    <td class="label">Edad:</td>
                    <td class="value">{{ $edad ?? '' }}</td>
                </tr>
            </table>

            <div class="section-title">Exámenes seleccionados</div>
            @php
                $examenes = isset($lab) && is_array($lab) ? array_filter($lab, function($item){ return $item !== 'Otros'; }) : [];
                $total = count($examenes);
                $mitad = (int) ceil($total / 2);
                $col1 = array_slice($examenes, 0, $mitad);
                $col2 = array_slice($examenes, $mitad);
            @endphp
            <div class="lab-list" style="columns:unset; -webkit-columns:unset; -moz-columns:unset;">
                @if($total > 0)
                    <table style="width:100%;">
                        <tr>
                            <td style="vertical-align:top; width:50%;">
                                @foreach($col1 as $examen)
                                    <div class="lab-item">{{ $examen }}</div>
                                @endforeach
                            </td>
                            <td style="vertical-align:top; width:50%;">
                                @foreach($col2 as $examen)
                                    <div class="lab-item">{{ $examen }}</div>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                @else
                    <div class="lab-item">No se seleccionaron exámenes</div>
                @endif
            </div>

            @if(isset($lab) && is_array($lab) && in_array('Otros', $lab) && !empty($otrosLab))
                <div class="section-title">Otros exámenes</div>
                <div class="otros-text">{{ $otrosLab }}</div>
            @endif

            @if(isset($medico))
                <div class="medico">
                    <span>Dr(a).</span>
                    <span class="medico-name">{{ $medico }}</span>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
