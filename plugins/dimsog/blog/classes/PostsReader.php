<?php

namespace Dimsog\Blog\Classes;

use Dimsog\Blog\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class PostsReader
{
    private int $categoryId = 0;


    public function setCategoryId(int $categoryId): self
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    public function read(): Collection
    {
        $query = Post::where('active', 1);
        if ($this->categoryId > 0) {
            $query->where('category_id', $this->categoryId);
        }
        $query->orderByDesc('id');
        return $query->get();
    }
}
