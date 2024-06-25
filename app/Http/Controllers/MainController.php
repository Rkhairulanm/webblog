<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $posts = Post::where('published', true)->orderBy('created_at', 'desc')->get();

        $title = 'Home';

        return view('layouts.index', compact('title', 'posts'));
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
        $tags = $post->tags->pluck('id')->toArray();
        $listcategory = Category::all();
        $taglist = Tag::take(20)->get();
        $related = Post::whereHas('tags', function ($q) use ($tags) {
            $q->whereIn('tags.id', $tags);
        })->where('id', '!=', $post->id)
            ->inRandomOrder()
            ->take(4)
            ->get();
        return view('layouts.post', compact('post', 'related', 'taglist', 'listcategory'));
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
                $posts = collect();
                $title = 'Hasil Pencarian Tidak Ditemukan';
            }
        } else {
            $posts = Post::paginate(4);
            $title = 'Category All';
        }

        $listcategory = Category::all();
        $taglist = Tag::take(20)->get();


        return view('layouts.category', compact('posts', 'title', 'listcategory', 'keyword', 'taglist'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $posts = Post::where('category_id', $category->id)
            ->paginate(4);

        $listcategory = Category::all();
        $title = $category->name;

        $postIds = $posts->pluck('id');

        $tags = Tag::whereHas('posts', function ($query) use ($postIds) {
            $query->whereIn('post_id', $postIds);
        })->get();

        $taglist = Tag::take(20)->get();


        return view('layouts.category', compact('category', 'posts', 'title', 'listcategory', 'tags', 'taglist'));
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;

        if (empty($keyword)) {
            return redirect()->back()->withErrors('Please enter a keyword to search.');
        }
        $query = Post::query();
        $query->where('title', 'LIKE', '%' . $keyword . '%')
            ->orWhereHas('category', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%');
            })
            ->orWhereHas('tags', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%');
            });

        $posts = $query->with('tags', 'category')->paginate(4);
        if ($posts->isEmpty()) {
            $title = 'Hasil Pencarian Tidak Ditemukan';
        } else {
            $title = 'Hasil Pencarian untuk: ' . $keyword;
        }
        $taglist = Tag::take(20)->get();
        $listcategory = Category::all();
        return view('layouts.search', compact('posts', 'title', 'listcategory', 'keyword', 'taglist'));
    }

    public function tag($name)
    {
        $tag = Tag::where('name', $name)->firstOrFail();

        $posts = $tag->posts()->paginate(10);

        $taglist = Tag::take(20)->get();

        $listcategory = Category::all();

        $title = 'Posts tagged with ' . $tag->name;

        return view('layouts.search', compact('tag', 'posts', 'taglist', 'listcategory', 'title'));
    }

    public function taglist()
    {
        $taglist = Tag::all();
        return view('layouts.taglist', compact('taglist'));
    }
}
