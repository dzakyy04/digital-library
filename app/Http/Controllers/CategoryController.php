<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Exception;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $title = 'Daftar Kategori';
            $categories = Category::withCount('books')->get();
            
            return view('dashboard.categories.index', compact('title', 'categories'));
        } catch (Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Terjadi kesalahan saat mengambil daftar kategori');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'slug' => 'required|unique:categories'
            ]);

            Category::create([
                'name' => $request->name,
                'slug' => $request->slug
            ]);

            return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan');
        } catch (Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Terjadi kesalahan saat menyimpan kategori');
        }
    }

    public function update(Request $request, $slug)
    {
        try {
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
        } catch (Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Terjadi kesalahan saat memperbarui kategori');
        }
    }

    public function destroy($slug)
    {
        try {
            $category = Category::where('slug', $slug)->firstOrFail();
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus');
        } catch (Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Terjadi kesalahan saat menghapus kategori');
        }
    }

    public function getCategory($slug)
    {
        try {
            $category = Category::where('slug', $slug)->firstOrFail();
            return response()->json([
                'category' => $category
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Kategori tidak ditemukan'], 404);
        }
    }

    public function checkSlug(Request $request)
    {
        try {
            $slug = $request->input('slug');
            $exists = Category::where('slug', $slug)->exists();
            $count = Category::where('slug', 'like', $slug . '%')->count();

            return response()->json([
                'exists' => $exists,
                'count' => $count
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan yang tidak terduga'], 500);
        }
    }
}
