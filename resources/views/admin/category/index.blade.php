<x-layout title="Catégories">
    <x-navigation-sidebar :items="\Honda\Navigation\Navigation::manager()">
        <div class="p-6">
            <div class="flex justify-between items-center">
                <x-ui-title level="h1" content="Catégories"/>
                <x-ui-link href="categories.create">
                    <x-ui-button content="Ajouter une catégorie"/>
                </x-ui-link>
            </div>
            <div class="mt-4">
                <livewire:category-table/>
            </div>
        </div>
    </x-navigation-sidebar>
</x-layout>
