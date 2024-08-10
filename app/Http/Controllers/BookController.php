<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index(Request $request)
    {
        try {
            $title = 'Daftar Buku Saya';

            $user = Auth::user();
            $books = Book::with('category')->where('user_id', $user->id)->get();
            return view('dashboard.books.index', compact('title', 'books'));
        } catch (Exception $e) {
            return redirect()->route('books.index')->with('error', 'Terjadi kesalahan saat mengambil daftar buku');
        }
    }
}
