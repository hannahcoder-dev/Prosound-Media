<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;

class BlogController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::active()->get();
        $posts = BlogPost::published()->with('author', 'category', 'tags')
            ->latest('published_at')->paginate(9);

        return view('public.blog', compact('categories', 'posts'));
    }

    public function show(string $slug)
    {
        $post = BlogPost::where('slug', $slug)->published()->with('author', 'category', 'tags')->firstOrFail();
        $post->increment('views_count');

        $relatedPosts = BlogPost::published()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->limit(3)->get();

        return view('public.blog-detail', compact('post', 'relatedPosts'));
    }

    public function category(string $slug)
    {
        $category = BlogCategory::where('slug', $slug)->firstOrFail();
        $categories = BlogCategory::active()->get();
        $posts = BlogPost::published()->where('category_id', $category->id)
            ->with('author', 'category')->latest('published_at')->paginate(9);

        return view('public.blog', compact('categories', 'posts', 'category'));
    }
}
