<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $query = Portfolio::with('category');

        if ($request->search) {
            $query->where('title', 'like', "%{$request->search}%");
        }
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        $portfolios = $query->latest()->paginate(15);
        $categories = PortfolioCategory::ordered()->get();

        return view('admin.portfolios.index', compact('portfolios', 'categories'));
    }

    public function create()
    {
        $categories = PortfolioCategory::active()->ordered()->get();
        return view('admin.portfolios.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:portfolio_categories,id',
            'description' => 'nullable|string',
            'media_type' => 'required|in:audio,video,image',
            'media_url' => 'nullable|string',
            'thumbnail_url' => 'nullable|string',
            'client_name' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'is_public' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $portfolio = Portfolio::create($validated);
        ActivityLog::log('portfolio.created', "Created portfolio: {$portfolio->title}", $portfolio);

        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio item created.');
    }

    public function edit(Portfolio $portfolio)
    {
        $categories = PortfolioCategory::active()->ordered()->get();
        return view('admin.portfolios.edit', compact('portfolio', 'categories'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:portfolio_categories,id',
            'description' => 'nullable|string',
            'media_type' => 'required|in:audio,video,image',
            'media_url' => 'nullable|string',
            'thumbnail_url' => 'nullable|string',
            'client_name' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'is_public' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $portfolio->update($validated);
        ActivityLog::log('portfolio.updated', "Updated portfolio: {$portfolio->title}", $portfolio);

        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio item updated.');
    }

    public function destroy(Portfolio $portfolio)
    {
        ActivityLog::log('portfolio.deleted', "Deleted portfolio: {$portfolio->title}");
        $portfolio->delete();

        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio item deleted.');
    }
}
