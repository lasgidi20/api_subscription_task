<?php

namespace App\Contract;

use App\Models\Post;

interface PostRepositoryInterface 
{
    public function getAllPost();
    public function createPost(array $attributes);
}
