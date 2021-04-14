<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TagController
{
    public function index()
    {
        return view('admin.tag.index');
    }

    public function create()
    {
        return view('admin.tag.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Tag::create($data);

        return redirect()->route('tags.index')->with([
            'success' => 'The resource has been updated created.',
        ]);
    }

    public function show(Tag $tag)
    {
        return view('admin.tag.show', [
            'tag' => $tag,
        ]);
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', [
            'tag' => $tag,
        ]);
    }

    public function update(Request $request, Tag $tag): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tag->update($data);

        return redirect()->route('tags.index')->with([
            'success' => 'The resource has been successfully updated.',
        ]);
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        $tag->delete();

        return redirect()->route('tags.index')->with([
            'success' => 'The resource has been successfully deleted.',
        ]);
    }
}
