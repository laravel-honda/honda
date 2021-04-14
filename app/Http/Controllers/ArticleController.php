<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ArticleController
{
    public function index()
    {
        return view('admin.article.index');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
        ]);
        Article::create($data);

        return redirect()->route('articles.index')->with([
            'success' => 'The resource has been updated created.',
        ]);
    }

    public function show(Article $article)
    {
        return view('admin.article.show', [
            'article' => $article,
        ]);
    }

    public function edit(Article $article)
    {
        return view('admin.article.edit', [
            'article' => $article,
        ]);
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $data = $request->validate([
        ]);
        $article->update($data);

        return redirect()->route('articles.index')->with([
            'success' => 'The resource has been successfully updated.',
        ]);
    }

    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();

        return redirect()->route('articles.index')->with([
            'success' => 'The resource has been successfully deleted.',
        ]);
    }
}
