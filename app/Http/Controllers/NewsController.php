<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    // Frontend: Display all news
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');

        $news = News::query()
            ->when($search, fn($query) => $query->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%"))
                ->orWhere('category', 'like', "%{$search}%")
            ->when($category, fn($query) => $query->where('category', $category))
            ->latest()
            ->paginate(9);

        // Fetch unique categories
        $categories = News::select('category')->distinct()->pluck('category')->toArray();
        if (Auth::user() && Auth::user()->role == 1) {
            return to_route('admin.dash');
        } elseif (Auth::user() && Auth::user()->role == 2) {
            return to_route('trainer.dashboard');
        } elseif (Auth::user() && Auth::user()->role == 3) {
            return to_route('student.dashboard');
        }

        return view('website.news.index', compact('news', 'categories'));
    }

    // Frontend: Display a single news article
    public function show($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        return view('website.news.show', compact('news'));
    }

    // Serve news image
    public function showImage(News $news)
    {
        if (!Str::startsWith($news->image, 'data:image')) {
            return response()->file(storage_path('app/news/' . $news->image));
        }
        return redirect($news->image_url);
    }

    // Admin: List news
    public function adminIndex()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    // Admin: Create news form
    public function create()
    {
        return view('admin.news.create');
    }

    // Admin: Store news
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'category' => 'required|string',
            'published_at' => 'required|date',
        ]);

        $data = $request->all();
        $data['created_by'] = Auth::id();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = base64_encode(file_get_contents($request->file('image')->path()));
            $data['image'] = 'data:image/' . $request->file('image')->extension() . ';base64,' . $image;
        }

        News::create($data);

        return redirect()->route('admin.news.index')->with('success', 'News created successfully.');
    }

    // Admin: Edit news form
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    // Admin: Update news
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'category' => 'required|string',
            'published_at' => 'required|date',
        ]);

        $data = $request->all();

        // Handle image update
        if ($request->hasFile('image')) {
            if (!Str::startsWith($news->image, 'data:image') && Storage::disk('secure')->exists($news->image)) {
                Storage::disk('secure')->delete($news->image);
            }
            $image = base64_encode(file_get_contents($request->file('image')->path()));
            $data['image'] = 'data:image/' . $request->file('image')->extension() . ';base64,' . $image;
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'News updated successfully.');
    }

    // Admin: Delete news
    public function destroy(News $news)
    {
        if (!Str::startsWith($news->image, 'data:image') && Storage::disk('secure')->exists($news->image)) {
            Storage::disk('secure')->delete($news->image);
        }
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'News deleted successfully.');
    }
}