<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;

class ServiceController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::active()->ordered()->with(['services' => fn($q) => $q->active()->orderBy('sort_order')])->get();
        $services = Service::active()->with('category')->orderBy('sort_order')->get();

        return view('public.services', compact('categories', 'services'));
    }

    public function show(string $slug)
    {
        $service = Service::where('slug', $slug)->active()->with('category')->firstOrFail();
        $relatedServices = Service::active()->where('category_id', $service->category_id)
            ->where('id', '!=', $service->id)->limit(3)->get();

        return view('public.service-detail', compact('service', 'relatedServices'));
    }
}
