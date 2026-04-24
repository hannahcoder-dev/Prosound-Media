<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\PortfolioCategory;

class PortfolioController extends Controller
{
    public function index()
    {
        $categories = PortfolioCategory::active()->ordered()->get();
        $portfolios = Portfolio::public()->with('category')->latest()->paginate(12);

        return view('public.portfolio', compact('categories', 'portfolios'));
    }

    public function show(string $slug)
    {
        $portfolio = Portfolio::where('slug', $slug)->public()->with('category')->firstOrFail();
        $portfolio->increment('views_count');
        $related = Portfolio::public()->where('category_id', $portfolio->category_id)
            ->where('id', '!=', $portfolio->id)->limit(4)->get();

        return view('public.portfolio-detail', compact('portfolio', 'related'));
    }
}
