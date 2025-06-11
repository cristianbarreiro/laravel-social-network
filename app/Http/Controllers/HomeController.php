<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page with posts feed and trending topics.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get posts with pagination, ordered by latest
        $posts = Post::with(['user', 'comments', 'likes'])
            ->latest()
            ->paginate(10);

        // Get trending topics (topics with most posts in the last 7 days)
        $trendingTopics = Topic::withCount(['posts' => function ($query) {
                $query->where('posts.created_at', '>=', now()->subDays(7));
            }])
            ->orderByDesc('posts_count')
            ->take(5)
            ->get();

        return view('home.index', compact('posts', 'trendingTopics'));
    }
}
