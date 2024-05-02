<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contract\PostRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Api\BaseController as BaseController;
use Validator;
use App\Models\User;

class PostController extends BaseController
{
    public function __construct(private PostRepositoryInterface $post_repository)
    {
    }
    
    public function index(): JsonResponse 
    {
        return response()->json([
            'data' => $this->post_repository->getAllPost()
        ]);
    }

    public function store(Request $request)
    {
        $attributes = [
            'title'=> $request->title,
            'description'=> $request->description,
            'user_id' => $request->user_id
        ];

        return response()->json(
            [
                'data' => $this->post_repository->createPost($attributes)
            ],
            Response::HTTP_CREATED
        );
    }
}

