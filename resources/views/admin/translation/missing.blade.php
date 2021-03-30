<x-layout title="Translations">
    <x-ui-container max-width="xl" class="mt-4">
        <x-ui-title content="Missing translations" level="h1"/>
        <div class="my-2 flex space-x-2 items-baseline">
            <span>From</span>
            <div class="border px-2 py-0.5 rounded bg-white">{{ $reference }}</div>
            <span>To</span>
            <div class="border px-2 py-0.5 rounded bg-white">{{ $language }}</div>
        </div>

        <ul class="space-y-4">
            @foreach($missing->get(\App\Services\TranslationManager::KEY_MISSING) as $key)
                <li class="border bg-white p-4 rounded-lg">
                    <span class="text-gray-700 font-semibold">{{ $key }}</span>
                    <x-ui-overline content="Original" color="gray" class="mt-2"/>
                    <p class="text-gray-700">
                        {{ app(\App\Services\TranslationManager::class)->translateIn($reference, $key) }}
                    </p>

                    <div class="flex justify-between items-center mt-2">
                        <x-ui-overline content="Proposal" color="gray" />
                    </div>
                    <p class="text-gray-700 mt-1 flex items-center">
                        Le champ :attribute est prohibé. <x-ui-icon class="text-gray-500 ml-2" name="pencil" size="4" />
                    </p>
                    <div class="flex space-x-4">
                        <x-ui-button content="Use" class="mt-4"/>
                    </div>
                </li>
            @endforeach
        </ul>
    </x-ui-container>
</x-layout>
