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
        $title = 'Home';

        return view('layouts.index', compact('posts', 'title'));
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

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = Post::where('category_id', $category->id)->get();
        $listcategory = Category::get();
        // dd($posts);
        $title = $category->name;
        return view('layouts.category', compact('category', 'posts', 'title', 'listcategory'));
    }
}
