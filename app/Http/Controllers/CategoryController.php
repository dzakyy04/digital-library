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

    public function update(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' . $slug . ',slug'
        ]);

        $category = Category::where('slug', $slug)->firstOrFail();

        $category->update([
            'name' => $request->name,
            'slug' => $request->slug
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus');
    }

    public function getCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        return response()->json([
            'category' => $category
        ]);
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
