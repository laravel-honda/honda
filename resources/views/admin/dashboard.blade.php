<x-layout title="Tableau de bord">
    <x-topbar :items="\Honda\Navigation\Navigation::dashboard()">
        <x-slot name="header">
            <div class="flex justify-between">
                <h1 class="text-3xl font-bold text-gray-900">
                    Dashboard
                </h1>

                <a href="{{ route('blocks.create') }}">
                    <x-ui-button color="blue">
                        Créer un block
                    </x-ui-button>
                </a>
            </div>
        </x-slot>
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <livewire:calendar/>
        </div>
    </x-topbar>
</x-layout>
