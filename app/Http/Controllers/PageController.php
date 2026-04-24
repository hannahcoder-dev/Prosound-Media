<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;

class PageController extends Controller
{
    public function about()
    {
        $testimonials = Testimonial::active()->orderBy('sort_order')->limit(6)->get();
        return view('public.about', compact('testimonials'));
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function pricing()
    {
        return view('public.pricing');
    }
}
