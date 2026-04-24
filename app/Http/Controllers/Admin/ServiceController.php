<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::with('category');

        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        $services = $query->orderBy('sort_order')->paginate(15);
        $categories = ServiceCategory::ordered()->get();

        return view('admin.services.index', compact('services', 'categories'));
    }

    public function create()
    {
        $categories = ServiceCategory::active()->ordered()->get();
        return view('admin.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:service_categories,id',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:255',
            'base_price' => 'required|numeric|min:0',
            'price_unit' => 'nullable|string|max:50',
            'features' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['features'] = $validated['features'] ? array_map('trim', explode("\n", $validated['features'])) : [];

        $service = Service::create($validated);
        ActivityLog::log('service.created', "Created service: {$service->name}", $service);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        $categories = ServiceCategory::active()->ordered()->get();
        return view('admin.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:service_categories,id',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:255',
            'base_price' => 'required|numeric|min:0',
            'price_unit' => 'nullable|string|max:50',
            'features' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['features'] = $validated['features'] ? array_map('trim', explode("\n", $validated['features'])) : [];

        $service->update($validated);
        ActivityLog::log('service.updated', "Updated service: {$service->name}", $service);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        ActivityLog::log('service.deleted', "Deleted service: {$service->name}");
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
