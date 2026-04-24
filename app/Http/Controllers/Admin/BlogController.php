<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::with('author', 'category');

        if ($request->search) {
            $query->where('title', 'like', "%{$request->search}%");
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $posts = $query->latest()->paginate(15);
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        $categories = BlogCategory::active()->get();
        $tags = BlogTag::all();
        return view('admin.blog.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:blog_categories,id',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'status' => 'required|in:draft,published,archived',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'tags' => 'nullable|array',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['slug'] = Str::slug($validated['title']);
        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        $post = BlogPost::create($validated);

        if ($request->tags) {
            $tagIds = collect($request->tags)->map(function ($tag) {
                return BlogTag::firstOrCreate(['name' => $tag], ['slug' => Str::slug($tag)])->id;
            });
            $post->tags()->sync($tagIds);
        }

        ActivityLog::log('blog.created', "Created post: {$post->title}", $post);

        return redirect()->route('admin.blog.index')->with('success', 'Post created.');
    }

    public function edit(BlogPost $post)
    {
        $categories = BlogCategory::active()->get();
        $tags = BlogTag::all();
        return view('admin.blog.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, BlogPost $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:blog_categories,id',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'status' => 'required|in:draft,published,archived',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'tags' => 'nullable|array',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        if ($validated['status'] === 'published' && !$post->published_at) {
            $validated['published_at'] = now();
        }

        $post->update($validated);

        if ($request->tags) {
            $tagIds = collect($request->tags)->map(function ($tag) {
                return BlogTag::firstOrCreate(['name' => $tag], ['slug' => Str::slug($tag)])->id;
            });
            $post->tags()->sync($tagIds);
        }

        ActivityLog::log('blog.updated', "Updated post: {$post->title}", $post);

        return redirect()->route('admin.blog.index')->with('success', 'Post updated.');
    }

    public function destroy(BlogPost $post)
    {
        ActivityLog::log('blog.deleted', "Deleted post: {$post->title}");
        $post->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Post deleted.');
    }
}
