<x-layout title="Article">
    <div>
        <header
            class="flex justify-between px-4 fixed top-0 inset-x-0 lg:static flex items-center bg-white shadow lg:h-20 z-20">
            <div class="flex">
                <a href="{{ route('articles.index') }}">
                    <x-ui-icon name="arrow-left" class="text-gray-500" size="6"/>
                </a>
            </div>
            <div>
                <span>/{{ $article->slug }}</span>
            </div>
            <div class="flex">
                <button wire:click="$toggle('settingsState')">
                    <x-ui-icon name="settings" size="6" class="text-gray-500"/>
                </button>
                <button wire:click="publish" class="ml-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="transform rotate-90 text-gray-500 h-6 w-6"
                         fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                </button>
            </div>
        </header>

        <div class="mt-8 max-w-7xl mx-auto">
            <div class="flex flex-col items-center justify-center">
                <div class="flex  w-full items-end mt-4" x-data="{}">
                    @if ($article->banner_image)
                        <img @click="$refs.fileDialogOpener.click()"
                             src="/storage/user_images/{{ $article->bannerImage->name }}"
                             alt=""
                             class="rounded-lg mt-2 w-full"/>
                    @else
                        <button type="button"
                                @click="$refs.fileDialogOpener.click();"
                                class="w-full bg-white border border-gray-300 h-96 cursor-pointer rounded-lg flex items-center justify-center text-gray-400 mt-2 focus:outline-none flex-col shadow-sm">
                            <x-ui-icon name="photo" size="10"/>
                            <p class="text-center text-gray-600 mt-4 leading-7">Envoyez une photo en appuyant n'importe
                                où
                                <br> sur le carré blanc</p>
                        </button>
                    @endif
                    @error('banner')
                    <span class="error">{{ $message }}</span>
                    @enderror
                    <label x-ref="fileDialogOpener" class="hidden">
                        <input type='file' class="hidden" wire:model="banner"/>
                    </label>
                </div>
                <x-ui-input wire:model.lazy="article.title" value="{{ $article->title }}"
                            class="text-center text-4xl font-medium  my-6" first/>
            </div>

            <div class="flex items-start space-x-4">
                <aside class="border rounded-lg w-1/3">
                    <header class="p-4 font-semibold text-gray-700">
                        Ingrédients
                    </header>
                    <div class="bg-white p-4 rounded-lg">
                        <ul class="space-y-4">
                            @forelse($article->ingredients as $ingredient)
                                <li class="flex justify-between items-center">
                                    <div>
                                        <p class="text-gray-700">{{ $ingredient->name }}</p>
                                        <span class="text-gray-500">{{ $ingredient->pivot->quantity }}</span>
                                    </div>
                                    <x-ui-button color="red" wire:click="removeIngredient({{ $ingredient }})">
                                        <x-ui-icon name="trash" size="6"/>
                                    </x-ui-button>
                                </li>
                            @empty
                                <p class="text-gray-700">
                                    Aucun ingrédient associé à cet article.
                                </p>
                            @endforelse
                        </ul>
                        <x-ui-button content="Ajouter un ingredient" color="green" class="w-full mt-4"
                                     wire:click="$toggle('addIngredientState')"
                        />
                    </div>
                </aside>
                <section class="border rounded-lg w-2/3">
                    <header class="p-4 flex flex-col">
                        <span class="text-gray-700 font-semibold">Préparation:&nbsp;</span>
                        <x-ui-input wire:model.lazy="article.making_time" placeholder="(vide)" first class="mt-1"/>
                    </header>
                    <section class="bg-white p-4 rounded-lg">
                        <x-trix name="content" wire:model="article.content"/>
                    </section>
                </section>
            </div>
        </div>
    </div>
</x-layout>
