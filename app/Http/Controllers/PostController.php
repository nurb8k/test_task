<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $data = Post::all();

        $this->successResponse(
            $data,
            'Posts retrieved successfully'
        );
    }

    public function store()
    {

    }

    public function show()
    {

    }

    public function update()
    {

    }


}
