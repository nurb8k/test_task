<?php

namespace App\Services;

use App\Models\Post;
use App\Traits\APIResponsesTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
class PostService
{
    use APIResponsesTrait;

    protected $client;

    private function constructUrl($endpoint)
    {
        $baseUrl = 'https://dummyjson.com/posts/';
        return $baseUrl . $endpoint;
    }

    public function getPosts()
    {

        $posts = Post::with('user:id,name')
            ->paginate(10)
            ->through(function ($post) {

                $dummyPost = Http::get($this->constructUrl($post->id))->json();

                return [
                    'id' => $post->id,
                    'title' => $dummyPost['title'],
                    'author_name' => $post->user->name,
                    'description' => Str::limit($dummyPost['body'], 128, '...'),
                ];
            });

        return $posts;
    }

    public function createPost(Request $request)
    {
        $post = Http::post($this->constructUrl('add'), [
            'title' => $request->title,
            'body' => $request->body,
            'userId' => auth()->id(),
        ]);

        $post = new Post([
            'user_id' => auth()->id(),
            'dummy_post_id' => $post['id'],
        ]);

        $post->save();

        return $post;
    }

    public function updatePost(Request $request, Post $post)
    {
        $post = Http::asForm()->patch($this->constructUrl($post->dummy_post_id), [
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return $post;
    }

    public function deletePost(Post $post)
    {
        $post->delete();

        return [];
    }
}