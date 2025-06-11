<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'comments.user'])
            ->latest()
            ->paginate(10);

        return view('feed.index', compact('posts'));
    }
} 