<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Livewire\Component;

class IndexArticle extends Component
{
    public $createArticleState = false;
    public $title;

    public function render()
    {
        return view('livewire.index-article');
    }

    public function createArticle()
    {
        $article = Article::create([
            'title' => $this->title,
        ]);

        return redirect()->route('articles.edit', [
            'article' => $article,
        ]);
    }
}
