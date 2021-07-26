<x-layout title="Créer un block">
    <x-topbar :items="\Honda\Navigation\Navigation::dashboard()">
        <x-slot name="header">
            <div class="flex justify-between">
                <h1 class="text-3xl font-bold text-gray-900">
                    Créer un block
                </h1>
            </div>
        </x-slot>
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <x-ui-form action="{{ route('blocks.store') }}">
                <x-ui-input name="title" color="blue" label="Titre" required placeholder="RDV chez le coiffeur"/>
                <x-ui-input name="cron" label="Expression CRON" color="blue" placeholder="* * * * *"/>
                <div class="flex space-x-4">
                    <div class="w-full">
                        <x-ui-input type="date" name="starts_at_date" label="Début" color="blue"/>
                        <x-ui-input type="time" name="starts_at_time" hide-label color="blue"/>
                    </div>
                    <div class="w-full">
                        <x-ui-input type="date" name="ends_at_date" label="Fin" color="blue"/>
                        <x-ui-input type="time" name="ends_at_time" hide-label color="blue"/>
                    </div>
                </div>
                <x-ui-button class="mt-4" color="blue">Ajouter le block</x-ui-button>
            </x-ui-form>
        </div>
    </x-topbar>
</x-layout>
