<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() 
    {
        return response([
            'user' => new UserResource(auth()->user()),
        ], 200);
    }

    public function userPost()
    {
        return response([
            'success' => true,
            'posts' => Post::where('user_id', auth()->id())->get(),
        ], 200);
    }
}
