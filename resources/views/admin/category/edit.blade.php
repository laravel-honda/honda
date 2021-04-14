<x-layout title="Catégorie">
    <x-navigation-sidebar :items="\Honda\Navigation\Navigation::manager()">
        <div class="p-6">
            <div class="flex justify-between items-center">
                <x-ui-title level="h1" content="Éditer une catégorie"/>
            </div>
            <x-ui-form action="{{ route('categories.update', ['category' => $category]) }}" class="mt-4" method="PUT">
                <x-ui-input name="name" value="{{ $category->name }}"/>
                <x-ui-button content="Éditer" class="mt-4"/>
            </x-ui-form>
        </div>
    </x-navigation-sidebar>
</x-layout>
