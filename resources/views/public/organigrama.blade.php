<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Organigrama') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="mb-4">Organigrama Institucional</h3>
                    <div style="text-align:center;">
                        <img src="{{ asset('assets/images/organigrama1.png') }}" alt="Organigrama ISTS" style="max-width:100%;height:auto;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.10);">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
