<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Beca - {{ $reporte->estudiante_cedula }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #003366; padding-bottom: 10px; }
        .title { font-weight: bold; font-size: 16px; text-transform: uppercase; margin-top: 10px; }
        .content { margin: 20px 0; line-height: 1.6; }
        .field { font-weight: bold; width: 150px; display: inline-block; }
        .footer { margin-top: 50px; text-align: center; }
        .signature { border-top: 1px solid #000; width: 200px; margin: 0 auto; padding-top: 5px; }
    </style>
</head>
<body>
    <div class="header">
        <div style="color: #003366; font-weight: bold;">UNIVERSIDAD NACIONAL EXPERIMENTAL DE GUAYANA</div>
        <div>Sede: {{ auth()->user()->sede }}</div>
        <div class="title">Comprobante de Solicitud de {{ $reporte->solicitud }}</div>
    </div>

    <div class="content">
        <p><span class="field">Fecha:</span> {{ $reporte->created_at->format('d/m/Y h:i A') }}</p>
        <p><span class="field">Estudiante:</span> {{ $reporte->estudiante->nombre }} {{ $reporte->estudiante->apellido }}</p>
        <p><span class="field">Cédula:</span> {{ $reporte->estudiante_cedula }}</p>
        <p><span class="field">Edad:</span> {{ $reporte->estudiante->edad }} años</p>
        <p><span class="field">Tipo de Trámite:</span> {{ $reporte->solicitud }}</p>
    </div>

    <div style="margin-top: 40px;">
        <p>Se certifica que el estudiante arriba mencionado ha realizado formalmente su solicitud ante el módulo de Bienestar Estudiantil.</p>
    </div>

    <div class="footer">
        <div class="signature">Firma del Responsable</div>
        <div style="font-size: 10px; margin-top: 5px;">{{ auth()->user()->name }}</div>
    </div>
</body>
</html>