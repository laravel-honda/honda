<?php

namespace App\Http\Livewire;

use App\Models\Article;
use App\Models\Category;
use App\Models\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditArticle extends Component
{
    use WithFileUploads;
    use Concerns\CreatesIngredient;
    use Concerns\AddsIngredient;
    use Concerns\RemovesIngredient;
    use Concerns\ManagesSettings;

    public Article $article;
    public $category;
    public $banner;
    public $bannerAlt;

    public array $rules = [
        'article.title'       => 'required|string|max:255',
        'article.content'     => 'required|string',
        'article.making_time' => 'required|string|max:255',
    ];

    public function updatedCategory()
    {
        $category = Category::where('id', $this->category)->get()->first();

        if (!$category) {
            return;
        }

        $this->article->category()->associate($category);
    }

    public function updatedBanner()
    {
        $this->validate([
            'banner' => 'required|image|max:8192',
        ]);

        $this->banner->store('public/user_images');

        $image = Image::create([
            'name' => $this->banner->hashName(),
            'alt'  => $this->bannerAlt,
        ]);

        $this->article->update([
            'banner_image' => $image->id,
        ]);

        return $this->refresh();
    }

    public function refresh()
    {
        return redirect()->route('articles.edit', ['article' => $this->article]);
    }

    public function mount(int $id)
    {
        $this->article = Article::with('ingredients')->where('id', $id)->firstOrFail();
    }

    public function publish()
    {
        $this->article->publish();

        return redirect()->route('articles.index');
    }

    public function updated(string $property, $value)
    {
        if (!str_starts_with($property, 'article.')) {
            return;
        }

        $property = substr($property, strlen('article.'));

        $this->article->update([
            $property => $value,
        ]);
    }

    public function render()
    {
        return view('livewire.edit-article');
    }
}
