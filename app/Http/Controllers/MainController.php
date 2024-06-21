<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $post = Post::where('published', true)->orderBy('created_at', 'desc')->get();
        $posts = Post::where('title', 'LIKE', '%' . $keyword . '%')
            ->where('published', true)->orderBy('created_at', 'desc')->get();
        $title = 'Home';

        return view('layouts.index', compact('posts', 'title', 'post'));
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

    public function categoryall(Request $request)
    {
        $keyword = $request->keyword;

        if ($keyword) {
            $category = Category::where('name', 'LIKE', '%' . $keyword . '%')->first();

            if ($category) {
                $posts = Post::where('category_id', $category->id)
                    ->paginate(4);
                $title = 'Hasil Pencarian untuk Kategori: ' . $category->name;
            } else {
                $posts = Post::paginate(4);
                $title = 'Category All';
            }
        } else {
            $posts = Post::paginate(4);
            $title = 'Category All';
        }

        $listcategory = Category::all();

        return view('layouts.category', compact('posts', 'title', 'listcategory', 'keyword'));
    }
    public function category(Request $request, $slug)
    {
        $keyword = $request->keyword;

        if ($keyword) {
            $category = Category::where('name', 'LIKE', '%' . $keyword . '%')
                ->where('slug', $slug)
                ->firstOrFail();
        } else {
            $category = Category::where('slug', $slug)->firstOrFail();
        }

        $posts = Post::where('category_id', $category->id)
            ->paginate(4);

        $listcategory = Category::all();
        $title = $category->name;

        return view('layouts.category', compact('category', 'posts', 'title', 'listcategory', 'keyword'));
    }
}
