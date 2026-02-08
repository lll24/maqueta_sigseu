<div class="space-y-6">
    <div class="bg-white p-6 shadow-xl rounded-2xl border-t-8 border-indigo-700">
        <div class="flex justify-between items-center mb-6">
            <h3 class="font-black text-2xl text-indigo-900 uppercase">Control Maestro de Becas</h3>
            <div class="space-x-3">
                <button onclick="document.getElementById('modalNuevaBeca').style.display='flex'" class="bg-indigo-700 text-white px-6 py-2 rounded-xl font-bold shadow-lg hover:bg-indigo-800 transition-all">
                    + CREAR NUEVA
                </button>
                <a href="{{ route('becas.global') }}" class="bg-red-700 text-white px-6 py-2 rounded-xl font-bold shadow-lg hover:bg-red-800 transition-all">
                    📥 EXPORTAR TODO (PDF)
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm border-collapse">
                <thead>
                    <tr class="bg-indigo-50 text-indigo-900 border-b-2 border-indigo-200">
                        <th class="p-4 uppercase font-black">Estudiante</th>
                        <th class="p-4 uppercase font-black">Cédula</th>
                        <th class="p-4 uppercase font-black">Edad</th>
                        <th class="p-4 uppercase font-black">Solicitud</th>
                        <th class="p-4 uppercase font-black">Fecha Registro</th>
                        <th class="p-4 text-right uppercase font-black">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($reportes as $rep)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-4 font-bold text-gray-800">{{ $rep->estudiante->nombre }} {{ $rep->estudiante->apellido }}</td>
                            <td class="p-4 text-gray-600">{{ $rep->estudiante_cedula }}</td>
                            <td class="p-4 text-gray-600">{{ $rep->estudiante->edad }} años</td>
                            <td class="p-4"><span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-black">{{ $rep->solicitud }}</span></td>
                            <td class="p-4 text-gray-500 italic">{{ $rep->created_at->format('d/m/Y h:i A') }}</td>
                            <td class="p-4 text-right">
                                <a href="{{ route('becas.individual', $rep->id) }}" class="inline-block bg-gray-100 hover:bg-red-100 text-red-600 font-bold py-1 px-3 rounded-lg border border-red-200 transition-all">
                                    🖨️ IMPRIMIR
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="modalNuevaBeca" style="display:none;" class="fixed inset-0 bg-black bg-opacity-60 items-center justify-center z-50">
    <div class="bg-white p-8 rounded-3xl shadow-2xl w-full max-w-2xl border-t-8 border-indigo-700">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-black text-indigo-900 text-2xl uppercase italic">Nueva Solicitud Administrativa</h2>
            <button onclick="document.getElementById('modalNuevaBeca').style.display='none'" class="text-gray-400 hover:text-red-600 text-2xl">&times;</button>
        </div>

        <form action="{{ route('becas.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-xs font-black text-gray-500 uppercase ml-1 mb-1">Cédula del Solicitante</label>
                    <input type="text" name="cedula" placeholder="Ej: 30810484" class="w-full border-2 border-indigo-100 p-3 rounded-xl focus:border-indigo-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-xs font-black text-gray-500 uppercase ml-1 mb-1">Nombre(s)</label>
                    <input type="text" name="nombre" placeholder="Fernando" class="w-full border-2 border-indigo-100 p-3 rounded-xl focus:border-indigo-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-xs font-black text-gray-500 uppercase ml-1 mb-1">Apellido(s)</label>
                    <input type="text" name="apellido" placeholder="Centeno" class="w-full border-2 border-indigo-100 p-3 rounded-xl focus:border-indigo-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-xs font-black text-gray-500 uppercase ml-1 mb-1">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" class="w-full border-2 border-indigo-100 p-3 rounded-xl focus:border-indigo-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-xs font-black text-gray-500 uppercase ml-1 mb-1">Tipo de Solicitud</label>
                    <select name="solicitud" class="w-full border-2 border-indigo-100 p-3 rounded-xl bg-white font-bold text-indigo-900 appearance-none">
                        <option value="Beca">BECA ESTUDIANTIL</option>
                        <option value="Ayuda Económica">AYUDA ECONÓMICA</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end pt-6">
                <button type="submit" class="bg-indigo-700 text-white px-10 py-4 rounded-2xl font-black shadow-xl hover:bg-indigo-800 transform hover:scale-105 transition-all">
                    💾 GUARDAR Y GENERAR REPORTE
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    // Buscamos el input de cédula dentro del modal
    const inputCedula = document.querySelector('input[name="cedula"]');

    inputCedula.addEventListener('blur', function() {
        const cedula = this.value;

        if (cedula.length > 6) { // Solo busca si la cédula parece real
            fetch(`/estudiantes/buscar/${cedula}`)
                .then(response => response.json())
                .then(data => {
                    if (data.existe) {
                        // Rellenamos los campos automáticamente con los datos de PostgreSQL
                        document.querySelector('input[name="nombre"]').value = data.nombre;
                        document.querySelector('input[name="apellido"]').value = data.apellido;
                        document.querySelector('input[name="fecha_nacimiento"]').value = data.fecha_nacimiento;
                        
                        // Opcional: le damos un estilo visual para indicar que ya existía
                        console.log('Estudiante cargado con éxito');
                    }
                })
                .catch(error => console.error('Error en la búsqueda:', error));
        }
    });
</script>