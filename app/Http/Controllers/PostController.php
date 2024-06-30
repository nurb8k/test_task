<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->getPosts();

        return $this->successResponse(
           $posts,
            'Posts retrieved successfully'
        );
    }

    public function store(PostRequest $request)
    {
        $post = $this->postService->createPost($request);

        return $this->successResponse(
            $post,
            'Post created successfully',
            201
        );
    }

    public function show($id)
    {
        $post = Post::with('user:id,name')
            ->findOrFail($id);
        return $this->successResponse(
            new PostResource($post),
            'Post retrieved successfully'
        );
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $post = $this->postService->updatePost($request, $post);

        return $this->successResponse(
            $post,
            'Post updated successfully'
        );
    }

    public function delete(Post $post)
    {
       $this->authorize('delete', $post);

       $this->postService->deletePost($post);

       return $this->successResponse(
           [],
           'Post deleted successfully'
       );
    }

}
