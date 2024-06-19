<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $posts = Post::where('published', true)->orderBy('created_at', 'desc')->get();
        $trendingPosts = Post::where('published', true)->orderBy('title', 'desc')->take(5)->get();
        $title = 'Home';

        return view('layouts.index', compact('posts', 'trendingPosts', 'title'));
    }
    public function post()
    {
        $content = Post::get();
        $post = new Post();
        $title = $post->title;
        return view('layouts.post', compact('title', 'content'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $category = Category::get();
        $title = $post->title;
        return view('layouts.post', compact('post', 'category', 'title'));
    }
}
