<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Portfolio;
use App\Models\BlogPost;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::active()->featured()->with('category')->limit(6)->get();
        $portfolios = Portfolio::public()->featured()->with('category')->limit(6)->get();
        $testimonials = Testimonial::active()->featured()->orderBy('sort_order')->limit(6)->get();
        $latestPosts = BlogPost::published()->with('author', 'category')->latest('published_at')->limit(3)->get();

        return view('public.home', compact('services', 'portfolios', 'testimonials', 'latestPosts'));
    }
}
