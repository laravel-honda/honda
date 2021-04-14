<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class IngredientController
{
    public function index()
    {
        return view('admin.ingredient.index');
    }

    public function create()
    {
        return view('admin.ingredient.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'             => 'required|string|max:255',
            'type'             => 'required|in:vegan,vegetarian,meat',
            'contains_gluten'  => 'sometimes|required|accepted',
            'contains_lactose' => 'sometimes|required|accepted',
        ]);
        Ingredient::create($data);

        return redirect()->route('ingredients.index')->with([
            'success' => 'The resource has been updated created.',
        ]);
    }

    public function show(Ingredient $ingredient)
    {
        return view('admin.ingredient.show', [
            'ingredient' => $ingredient,
        ]);
    }

    public function edit(Ingredient $ingredient)
    {
        return view('admin.ingredient.edit', [
            'ingredient' => $ingredient,
        ]);
    }

    public function update(Request $request, Ingredient $ingredient): RedirectResponse
    {
        $data = $request->validate([
            'name'             => 'required|string|max:255',
            'type'             => 'required|in:vegan,vegetarian,meat',
            'contains_gluten'  => 'sometimes|required|accepted',
            'contains_lactose' => 'sometimes|required|accepted',
        ]);

        $ingredient->update($data);

        return redirect()->route('ingredients.index')->with([
            'success' => 'The resource has been successfully updated.',
        ]);
    }

    public function destroy(Ingredient $ingredient): RedirectResponse
    {
        $ingredient->delete();

        return redirect()->route('ingredients.index')->with([
            'success' => 'The resource has been successfully deleted.',
        ]);
    }
}
