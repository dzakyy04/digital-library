<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $title = 'Daftar Kategori';
        $categories = Category::withCount('books')->get();
        return view('dashboard.categories.index', compact('title', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function checkSlug(Request $request)
    {
        $slug = $request->input('slug');
        $exists = Category::where('slug', $slug)->exists();

        $count = Category::where('slug', 'like', $slug . '%')->count();

        return response()->json([
            'exists' => $exists,
            'count' => $count
        ]);
    }
}
