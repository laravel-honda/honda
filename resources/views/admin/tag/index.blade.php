<x-layout title="Tags">
    <x-navigation-sidebar :items="\Honda\Navigation\Navigation::manager()">
        <div class="p-6">
            <div class="flex justify-between items-center">
                <x-ui-title level="h1" content="Tags"/>
                <x-ui-link href="tags.create">
                    <x-ui-button content="Ajouter un tag"/>
                </x-ui-link>
            </div>
            <div class="mt-4">
                <livewire:tag-table/>
            </div>
        </div>
    </x-navigation-sidebar>
</x-layout>
