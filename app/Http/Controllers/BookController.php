<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index(Request $request)
    {
        try {
            $title = 'Daftar Buku Saya';
            $user = Auth::user();

            $selectedCategories = $request->input('kategori', []);
            $query = Book::with('category')->where('user_id', $user->id);

            if (!empty($selectedCategories)) {
                $query->where(function ($q) use ($selectedCategories) {
                    foreach ($selectedCategories as $category) {
                        if ($category === '-') {
                            $q->orWhereNull('category_id');
                        } else {
                            $categoryId = Category::where('slug', $category)->value('id');
                            if ($categoryId) {
                                $q->orWhere('category_id', $categoryId);
                            }
                        }
                    }
                });
            }

            $books = $query->get();
            $categories = Category::orderBy('name')->get();

            return view('dashboard.books.index', compact('title', 'books', 'categories', 'selectedCategories'));
        } catch (Exception $e) {
            return redirect()->route('books.index')->with('error', 'Terjadi kesalahan saat mengambil daftar buku');
        }
    }
}
