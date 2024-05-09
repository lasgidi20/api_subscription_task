<?php

namespace App\Repositories;

use App\Contract\PostRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Models\User;
use App\Models\Subscription;

class PostRepository implements PostRepositoryInterface 
{
    public function getAllPost() 
    {
        return Post::all();
    }

    public function createPost(array $attributes) 
    {
        return Post::create($attributes);
    }
}
