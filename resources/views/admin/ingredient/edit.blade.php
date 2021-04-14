<x-layout title="Ingrédient">
    <x-navigation-sidebar :items="\Honda\Navigation\Navigation::manager()">
        <div class="p-6">
            <div class="flex justify-between items-center">
                <x-ui-title level="h1" content="Éditer un ingrédient"/>
            </div>
            <x-ui-form action="{{ route('ingredients.update', ['ingredient' => $ingredient]) }}" method="PUT"
                       class="mt-4">
                <x-ui-input name="name" value="{{ $ingredient->name }}"/>
                <x-radio name="type" label="Type" :values="\App\Models\Ingredient::TYPES"
                         selected="{{$ingredient->type}}"/>
                <x-ui-checkbox name="contains_gluten"
                               @if ($ingredient->contains_gluten) checked @endif
                               label="Contient du gluten"/>
                <x-ui-checkbox name="contains_lactose"
                               @if ($ingredient->contains_lactose) checked @endif
                               label="Contient du lactose"/>
                <x-ui-button content="Éditer" class="mt-4"/>
            </x-ui-form>
        </div>
    </x-navigation-sidebar>
</x-layout>
