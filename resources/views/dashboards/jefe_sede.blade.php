<div class="space-y-10">
    <div class="bg-white p-6 shadow rounded-lg border-b-4 border-blue-800">
        <div class="flex justify-between items-center mb-6">
            <h3 class="font-bold text-xl text-blue-900 underline">Gestión Real de Personal UNEG</h3>
            <button onclick="document.getElementById('modalCrear').style.display='flex'" class="bg-blue-700 text-white px-6 py-2 rounded-lg font-black hover:bg-blue-800 shadow-md">
                + REGISTRAR ADMIN
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($sedesConAdmin as $nombreSede => $usuarios)
                <div class="bg-gray-50 border-2 border-blue-100 p-4 rounded-xl shadow-inner">
                    <h4 class="font-black text-blue-800 uppercase text-sm mb-3 border-b border-blue-200">Sede: {{ $nombreSede }}</h4>
                    @foreach($usuarios as $u)
                        <div class="flex justify-between items-center bg-white p-2 rounded mb-2 shadow-sm">
                            <div class="text-xs">
                                <p class="font-bold text-gray-800">{{ $u->name }}</p>
                                <p class="text-blue-600 font-medium">Mod: {{ $u->modulo }}</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button onclick="openEditModal({{ $u->toJson() }})" class="text-blue-500 hover:text-blue-700 font-black text-lg">✎</button>
                                
                                <form action="{{ route('users.destroy', $u->id) }}" method="POST" onsubmit="return confirm('¿Eliminar a este administrador?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-black text-lg">🗑</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>

<div id="modalCrear" style="display:none;" class="fixed inset-0 bg-black bg-opacity-60 items-center justify-center z-50">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md border-4 border-blue-700">
        <h2 class="font-black text-blue-900 text-xl mb-6 text-center uppercase">Nuevo Responsable de Módulo</h2>
        <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="text" name="name" placeholder="Nombre y Apellido" class="w-full border-2 border-gray-200 p-3 rounded-lg focus:border-blue-500 outline-none" required>
            <input type="email" name="email" placeholder="Correo @uneg.edu.ve" class="w-full border-2 border-gray-200 p-3 rounded-lg focus:border-blue-500 outline-none" required>
            <input type="password" name="password" placeholder="Contraseña de Acceso" class="w-full border-2 border-gray-200 p-3 rounded-lg focus:border-blue-500 outline-none" required>
            
            <div class="grid grid-cols-2 gap-4">
                <select name="sede" class="w-full border-2 border-gray-200 p-3 rounded-lg bg-white font-bold text-gray-700" required>
                    <option value="Villa Asia">Villa Asia</option>
                    <option value="Puerto Ordaz">Puerto Ordaz</option>
                    <option value="Atlántico">Sede Atlántico</option>
                </select>
                <select name="modulo" class="w-full border-2 border-gray-200 p-3 rounded-lg bg-white font-bold text-gray-700" required>
                    <option value="Becas">Becas</option>
                    <option value="Salud">Salud</option>
                    <option value="Orientación">Orientación</option>
                </select>
            </div>

            <div class="flex justify-between items-center pt-4">
                <button type="button" onclick="document.getElementById('modalCrear').style.display='none'" class="text-red-600 font-black uppercase text-xs tracking-widest hover:underline">Cancelar</button>
                <button type="submit" class="bg-blue-700 text-white px-8 py-3 rounded-xl font-black shadow-lg hover:bg-blue-800 transition-all">GUARDAR</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEditar" style="display:none;" class="fixed inset-0 bg-black bg-opacity-60 items-center justify-center z-50">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md border-4 border-yellow-500">
        <h2 class="font-black text-yellow-700 text-xl mb-6 text-center uppercase">Editar Administrador</h2>
        <form id="formEditar" method="POST" class="space-y-4">
            @csrf @method('PATCH')
            <input type="text" name="name" id="edit_name" placeholder="Nombre" class="w-full border-2 border-gray-200 p-3 rounded-lg outline-none" required>
            
            <div class="grid grid-cols-2 gap-4">
                <select name="sede" id="edit_sede" class="w-full border-2 border-gray-200 p-3 rounded-lg bg-white font-bold text-gray-700" required>
                    <option value="Villa Asia">Villa Asia</option>
                    <option value="Puerto Ordaz">Puerto Ordaz</option>
                    <option value="Atlántico">Atlántico</option>
                </select>
                <select name="modulo" id="edit_modulo" class="w-full border-2 border-gray-200 p-3 rounded-lg bg-white font-bold text-gray-700" required>
                    <option value="Becas">Becas</option>
                    <option value="Salud">Salud</option>
                    <option value="Orientación">Orientación</option>
                </select>
            </div>

            <div class="flex justify-between items-center pt-4">
                <button type="button" onclick="document.getElementById('modalEditar').style.display='none'" class="text-gray-500 font-black uppercase text-xs hover:underline">Cerrar</button>
                <button type="submit" class="bg-yellow-600 text-white px-8 py-3 rounded-xl font-black shadow-lg hover:bg-yellow-700 transition-all">ACTUALIZAR</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(user) {
        document.getElementById('formEditar').action = '/admin/users/' + user.id;
        document.getElementById('edit_name').value = user.name;
        document.getElementById('edit_sede').value = user.sede;
        document.getElementById('edit_modulo').value = user.modulo;
        document.getElementById('modalEditar').style.display = 'flex';
    }
</script>
@if ($errors->any())
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 shadow-sm">
        <p class="font-bold">El registro falló por lo siguiente:</p>
        <ul class="list-disc ml-5 text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif