<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sistema Integral de Gestión de Servicios Estudiantiles - UNEG') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            @if(auth()->user()->role == 'admin_global')
                @include('dashboards.jefe_sede')
            @endif

            @if(auth()->user()->modulo == 'Becas')
                @include('becas.reportes')
            @endif

        </div>
    </div>
</x-app-layout>