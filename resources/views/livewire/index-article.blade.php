<x-navigation-sidebar :items="\Honda\Navigation\Navigation::manager()">
    <div class="p-6">
        <div class="flex justify-between items-center">
            <x-ui-title level="h1" content="Articles"/>
            <x-ui-button content="Ajouter un article" wire:click="$toggle('createArticleState')"/>
            <x-modal wire:model="createArticleState">
                <x-ui-form wire:submit.prevent="createArticle">
                    <div class="px-6 py-4">
                        <span class="text-lg">Créer un article</span>
                        <x-ui-input wire:model="title" name="title" label="Titre"/>
                    </div>
                    <div class="flex justify-end px-6 py-4 mt-2 bg-gray-100 text-right">
                        <x-ui-button color="gray" wire:click.prevent="$toggle('createArticleState')" content="Annuler"/>
                        <x-ui-button content="Ajouter" class="ml-4"/>
                    </div>
                </x-ui-form>
            </x-modal>
        </div>
        <div class="mt-4">
            <livewire:article-table/>
        </div>
    </div>
</x-navigation-sidebar>
