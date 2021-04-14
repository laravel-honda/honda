<x-layout title="Tags">
    <x-navigation-sidebar :items="\Honda\Navigation\Navigation::manager()">
        <div class="p-6">
            <div class="flex justify-between items-center">
                <x-ui-title level="h1" content="Créer un tag"/>
            </div>
            <x-ui-form action="tags.store" class="mt-4">
                <x-ui-input name="name"/>
                <x-ui-button content="Créer" class="mt-4"/>
            </x-ui-form>
        </div>
    </x-navigation-sidebar>
</x-layout>
