<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contract\PostRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Api\BaseController as BaseController;

use App\Models\User;

class PostController extends BaseController
{
    public function __construct(private PostRepositoryInterface $post_repository)
    {
    }
    
    public function index()
    {
        $posts = $this->post_repository->getAllPost();
        
        return $this->sendResponse($posts, 'Posts fetched Successfully');
    }

    public function store(PostRequest $request)
    {
        $attributes = [
            'title'=> $request->title,
            'user_id'=> $request->user_id,
            'description' => $request->description,
        ];

        $post_data = $this->post_repository->createPost($attributes);
        
        return $this->sendResponse($post_data, 'Posts fetched Successfully');
    }
}

