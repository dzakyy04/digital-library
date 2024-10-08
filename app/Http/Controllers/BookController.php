<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    public function all(Request $request)
    {
        if (!Gate::allows('admin-access')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $title = 'Daftar Buku';

            $selectedCategories = $request->input('kategori', []);
            $query = Book::with(['category', 'user']);

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

            return view('dashboard.books.all', compact('title', 'books', 'categories', 'selectedCategories'));
        } catch (Exception $e) {
            return redirect()->route('books.all')->with('error', 'Terjadi kesalahan saat mengambil daftar buku');
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

            return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())
                ->with('error', 'Terjadi kesalahan dalam validasi. Silakan periksa data yang Anda masukkan')
                ->withInput();
        } catch (Exception $e) {
            return redirect()->route('books.create')->with('error', $e->getMessage());
        }
    }

    public function edit($slug)
    {
        $title = 'Edit Buku';
        $book = Book::where('slug', $slug)->firstOrFail();
        session(['books_previous_url' => url()->previous()]);
        if (Auth::id() !== $book->user_id && Auth::user()->role != 'admin') {
            return redirect()->route('books.index')->with('error', 'Anda tidak memiliki izin untuk mengedit buku ini');
        }
        $categories = Category::orderBy('name')->get();
        return view('dashboard.books.edit', compact('title', 'book', 'categories'));
    }

    public function update(Request $request, $slug)
    {
        try {
            $book = Book::where('slug', $slug)->firstOrFail();

            if (Auth::id() !== $book->user_id && Auth::user()->role != 'admin') {
                return $this->redirectBack('error', 'Anda tidak memiliki izin untuk mengedit buku ini');
            }

            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'quantity' => 'required|integer|min:0',
            ]);

            $validatedData['slug'] = $this->generateUniqueSlug($request->title);
            $validatedData['user_id'] = Auth::user()->id;

            if ($request->hasFile('file_path')) {
                if ($book->file_path) {
                    Storage::disk('public')->delete('books/files/' . basename($book->file_path));
                }
                $fileName = $validatedData['slug'] . '-' . time() . '.' . $request->file_path->getClientOriginalExtension();
                $filePath = $request->file_path->storeAs('books/files', $fileName, 'public');
                $validatedData['file_path'] = url(Storage::url($filePath));
            }

            if ($request->hasFile('cover_path')) {
                if ($book->cover_path) {
                    Storage::disk('public')->delete('books/covers/' . basename($book->cover_path));
                }
                $coverName = $validatedData['slug'] . '-' . time() . '.' . $request->cover_path->getClientOriginalExtension();
                $coverPath = $request->cover_path->storeAs('books/covers', $coverName, 'public');
                $validatedData['cover_path'] = url(Storage::url($coverPath));
            }

            $book->update($validatedData);

            return $this->redirectBack('success', 'Buku berhasil diperbarui');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())
                ->with('error', 'Terjadi kesalahan dalam validasi. Silakan periksa data yang Anda masukkan')
                ->withInput();
        } catch (Exception $e) {
            return $this->redirectBack('error', 'Terjadi kesalahan saat memperbarui buku');
        }
    }

    public function destroy($slug)
    {
        try {
            $book = Book::where('slug', $slug)->firstOrFail();
            if (Auth::id() !== $book->user_id && Auth::user()->role != 'admin') {
                return $this->redirectBack('error', 'Anda tidak memiliki izin untuk menghapus buku ini');
            }
            if ($book->file_path) {
                Storage::disk('public')->delete('books/files/' . basename($book->file_path));
            }
            if ($book->cover_path) {
                Storage::disk('public')->delete('books/covers/' . basename($book->cover_path));
            }
            $book->delete();
            return $this->redirectBack('success', 'Buku berhasil dihapus');
        } catch (ModelNotFoundException $e) {
            return $this->redirectBack('error', 'Buku tidak ditemukan');
        } catch (Exception $e) {
            return $this->redirectBack('error', 'Terjadi kesalahan saat menghapus buku');
        }
    }

    public function download($slug)
    {
        try {
            $book = Book::where('slug', $slug)->firstOrFail();

            if (Auth::id() !== $book->user_id && Auth::user()->role != 'admin') {
                return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengunduh buku ini');
            }

            $fileName = basename($book->file_path);

            $filePath = storage_path('app/public/books/files/' . $fileName);

            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File tidak ditemukan');
            }

            return response()->download($filePath, $fileName);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('books.index')->with('error', 'Buku tidak ditemukan');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunduh file');
        }
    }

    public function getBook($slug)
    {
        try {
            $book = Book::where('slug', $slug)->with(['category', 'user'])->firstOrFail();
            if (Auth::id() !== $book->user_id && Auth::user()->role != 'admin') {
                return response()->json([
                    'error' => 'Anda tidak memiliki izin untuk melihat buku ini'
                ], 403);
            }

            return response()->json([
                'book' => $book
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Buku tidak ditemukan'], 404);
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

    private function redirectBack($type, $message)
    {
        $previousUrl = session('books_previous_url', url()->previous());
        session()->forget('books_previous_url');

        if ($previousUrl === route('books.all')) {
            return redirect()->route('books.all')->with($type, $message);
        }
        return redirect()->route('books.index')->with($type, $message);
    }
}
