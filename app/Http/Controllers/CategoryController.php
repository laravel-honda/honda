<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController
{
    public function index()
    {
        return view('admin.category.index');
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Category::create($data);

        return redirect()->route('categories.index')->with([
            'success' => 'The resource has been updated created.',
        ]);
    }

    public function show(Category $category)
    {
        return view('admin.category.show', [
            'category' => $category,
        ]);
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category->update($data);

        return redirect()->route('categories.index')->with([
            'success' => 'The resource has been successfully updated.',
        ]);
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('categories.index')->with([
            'success' => 'The resource has been successfully deleted.',
        ]);
    }
}
