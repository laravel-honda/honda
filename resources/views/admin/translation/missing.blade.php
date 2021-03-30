<x-layout title="Translations">
    <x-ui-container max-width="xl" class="mt-4">
        <x-ui-title content="Missing translations" level="h1"/>
        <div class="my-2 flex space-x-2 items-baseline">
            <span>From</span>
            <div
                class="border px-2 py-0.5 rounded bg-white text-{{ settings('color') }}-600 font-semibold">{{ $reference }}</div>
            <span>To</span>
            <div
                class="border px-2 py-0.5 rounded bg-white text-{{ settings('color') }}-600 font-semibold">{{ $language }}</div>
        </div>

        <ul class="space-y-4">
            @foreach($missing->get(\App\Services\Translation\TranslationFileManager::KEY_MISSING) as $key)
                <li class="border bg-white p-4 rounded-lg">
                    <span class="text-gray-700 font-semibold">{{ $key }}</span>
                    <div class="mt-2">
                        <x-ui-input
                            name="original"
                            disabled
                            first
                            :value="app(\App\Services\Translation\TranslationFileManager::class)->translateIn($reference, $key)"
                        />
                        <x-ui-textarea
                            name="proposal"
                            :value="app(\App\Services\Translation\TranslationFileManager::class)->findProposalFor($key, $language, $reference)"
                        />
                    </div>
                    <x-ui-button content="Use" class="mt-4"/>
                </li>
            @endforeach
        </ul>
    </x-ui-container>
</x-layout>
