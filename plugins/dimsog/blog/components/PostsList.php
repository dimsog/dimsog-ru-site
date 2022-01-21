<?php namespace Dimsog\Blog\Components;

use Cms\Classes\ComponentBase;
use Dimsog\Blog\Classes\PostsReader;
use Dimsog\Blog\Models\Category;
use Dimsog\Blog\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class PostsList extends ComponentBase
{
    private ?Category $category;

    private Collection $posts;


    public function componentDetails(): array
    {
        return [
            'name'        => 'Список записей',
            'description' => ''
        ];
    }

    public function onRun()
    {
        $reader = new PostsReader();
        $this->category = Category::findBySlug($this->property('categorySlug'));
        $reader->setCategoryId((int) $this->category?->id);
        $this->posts = $reader->read();

        $this->page['activeCategory'] = $this->category;
    }

    public function onRender(): void
    {
        $this->page['category'] = $this->category;
        $this->page['items'] = $this->posts;
    }

    public function defineProperties(): array
    {
        return [
            'categorySlug' => [
                'title' => 'URL категории',
                'description' => 'Укажите категорию, из которой брать записи',
                'default' => null,
                'type' => 'string'
            ],
        ];
    }
}
