<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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

    public function create()
    {
        $title = 'Tambah Buku Baru';
        $categories = Category::orderBy('name')->get();
        return view('dashboard.books.create', compact('title', 'categories'));
    }

    public function store(Request $request)
    {
        try {
            $book = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'quantity' => 'required|integer|min:0',
                'file_path' => 'required|file|mimes:pdf|max:2048',
                'cover_path' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $book['slug'] = $this->generateUniqueSlug($request->title);
            $book['user_id'] = Auth::user()->id;

            if ($request->hasFile('file_path')) {
                $fileName = $book['slug'] . '-' . time() . '.' . $request->file_path->getClientOriginalExtension();
                $filePath = $request->file_path->storeAs('books/files', $fileName, 'public');
                $book['file_path'] = url(Storage::url($filePath));
            }

            if ($request->hasFile('cover_path')) {
                $coverName = $book['slug'] . '-' . time() . '.' . $request->cover_path->getClientOriginalExtension();
                $coverPath = $request->cover_path->storeAs('books/covers', $coverName, 'public');
                $book['cover_path'] = url(Storage::url($coverPath));
            }

            Book::create($book);

            return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())
                ->with('error', 'Terjadi kesalahan dalam validasi. Silakan periksa data yang Anda masukkan.')
                ->withInput();
        } catch (Exception $e) {
            return redirect()->route('books.create')->with('error', $e->getMessage());
        }
    }

    private function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $slugBase = $slug;
        $count = 1;

        while (Book::where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
