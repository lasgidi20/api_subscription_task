<?php

namespace App\Repositories;

use App\Contract\PostRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use App\Models\Post;

class PostRepository implements PostRepositoryInterface 
{
    public function getAllPost() 
    {
        return Post::all();
    }

    public function createPost(array $attributes) 
    {
        // if (! Gate::allows('isTeacher')) {
         //   abort(403);
        // }

        return Post::create($attributes);
    }
}
