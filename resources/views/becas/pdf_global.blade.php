<!DOCTYPE html>
<html>
<head>
    <title>Reporte Global de Becas - UNEG</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 10px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 3px solid #003366; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #003366; color: white; padding: 8px; text-transform: uppercase; }
        td { padding: 8px; border-bottom: 1px solid #ddd; text-align: center; }
        /* Toque extra: Filas de colores intercalados para que sea más fácil de leer */
        tr:nth-child(even) { background-color: #f2f2f2; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: right; font-size: 8px; }
    </style>
</head>
<body>
    <div class="header">
        <h2 style="color: #003366; margin: 0;">UNIVERSIDAD NACIONAL EXPERIMENTAL DE GUAYANA</h2>
        <p style="margin: 5px 0;">LISTADO MAESTRO DE SOLICITUDES DE BECAS - SEDE: {{ auth()->user()->sede }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Cédula</th>
                <th>Estudiante</th>
                <th>Edad</th>
                <th>Solicitud</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reportes as $rep)
                <tr>
                    <td>{{ $rep->created_at->format('d/m/Y') }}</td>
                    
                    <td>{{ $rep->estudiante_cedula }}</td>
                    
                    <td style="text-align: left;">{{ $rep->estudiante->nombre }} {{ $rep->estudiante->apellido }}</td>
                    
                    <td>{{ $rep->estudiante->edad }} años</td> 
                    
                    <td><strong>{{ $rep->solicitud }}</strong></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Generado por: {{ auth()->user()->name }} | Fecha: {{ date('d/m/Y h:i A') }}
    </div>
</body>
</html>