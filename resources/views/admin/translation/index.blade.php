<x-layout title="Translations">
    <x-ui-container max-width="xl" class="mt-4">
        <x-ui-title content="Translations" level="h1"/>

        <x-ui-title content="Missing translations" level="h2" class="mt-4"/>
        <form action="{{ route('translations.missing') }}" method="GET">
            <div class="flex space-x-2">
                <x-ui-select name="language"
                             :values="app(\App\Services\Translation\TranslationFileManager::class)->languages()->toArray()"/>
                <x-ui-select name="reference"
                             :values="app(\App\Services\Translation\TranslationFileManager::class)->languages()->toArray()"/>
            </div>
            <x-ui-button content="Search" class="mt-4"/>
        </form>

        <x-ui-title content="All translations" level="h2" class="mt-4"/>
        <div class="space-y-4 mt-2">
            @foreach($translations as $translation)
                @php([$group, $key] = explode('.', $translation->key, 2))
                <div class="border bg-white rounded-lg p-4">
                    <x-ui-overline :content="$group"/>
                    <span class="mt-1 text-gray-700">{{ $key }}</span>
                    <ul class="space-y-3 mt-2">
                        @foreach($translation->entries as $lang => $translated)
                            <li class="flex flex-wrap items-end">
                                <div
                                    class="w-12 mr-2 bg-{{ settings('color') }}-100 rounded text-{{ settings('color') }}-600 font-semibold inline-flex items-center justify-center">{{ $lang }}</div>
                                <div class="mt-2 flex-shrink text-gray-700">{{ $translated }}</div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </x-ui-container>

</x-layout>
