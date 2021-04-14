<x-layout title="Ingrédients">
    <x-navigation-sidebar :items="\Honda\Navigation\Navigation::manager()">
        <div class="p-6">
            <div class="flex justify-between items-center">
                <x-ui-title level="h1" content="Ingrédients"/>
                <x-ui-link href="ingredients.create">
                    <x-ui-button content="Ajouter un ingrédient"/>
                </x-ui-link>
            </div>
            <div class="mt-4">
                <livewire:ingredient-table/>
            </div>
        </div>
    </x-navigation-sidebar>
</x-layout>
