<x-layout title="Tags">
    <x-navigation-sidebar :items="\Honda\Navigation\Navigation::manager()">
        <div class="p-6">
            <div class="flex justify-between items-center">
                <x-ui-title level="h1" content="Éditer un tag"/>
            </div>
            <x-ui-form action="{{ route('tags.update', ['tag' => $tag]) }}" ² class="mt-4">
                <x-ui-input name="name" value="{{ $tag->name }}"/>
                <x-ui-button content="Éditer" class="mt-4"/>
            </x-ui-form>
        </div>
    </x-navigation-sidebar>
</x-layout>
