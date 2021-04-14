<x-layout title="Ingrédient">
    <x-navigation-sidebar :items="\Honda\Navigation\Navigation::manager()">
        <div class="p-6">
            <div class="flex justify-between items-center">
                <x-ui-title level="h1" content="Ajouter un ingrédient"/>
            </div>
            <x-ui-form action="ingredients.store" class="mt-4">
                <x-ui-input name="name"/>
                <x-radio name="type" label="Type" :values="\App\Models\Ingredient::TYPES"/>
                <x-ui-checkbox name="contains_gluten"
                               label="Contient du gluten"/>
                <x-ui-checkbox name="contains_lactose"
                               label="Contient du lactose"/>
                <x-ui-button content="Créer" class="mt-4"/>
            </x-ui-form>
        </div>
    </x-navigation-sidebar>
</x-layout>
