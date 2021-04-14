<x-layout title="Catégorie">
    <x-navigation-sidebar :items="\Honda\Navigation\Navigation::manager()">
        <div class="p-6">
            <div class="flex justify-between items-center">
                <x-ui-title level="h1" content="Créer une catégorie"/>
            </div>
            <x-ui-form action="categories.store" class="mt-4">
                <x-ui-input name="name"/>
                <x-ui-button content="Créer" class="mt-4"/>
            </x-ui-form>
        </div>
    </x-navigation-sidebar>
</x-layout>
