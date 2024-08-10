<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class BookExportController extends Controller
{
    public function exportMyBook()
    {
        $userId = Auth::user()->id;
        $books = Book::where('user_id', $userId)->get();
        $books->transform(function ($book) {
            $filename = basename($book->cover_path);
            $book->cover_path = 'storage/books/covers/' . $filename;
            return $book;
        });

        $pdf = Pdf::loadView('exports.pdf.books', compact('books'));

        return $pdf->download('buku-saya.pdf');
    }

    public function exportMyBookTable()
    {
        $userId = Auth::user()->id;
        $books = Book::where('user_id', $userId)->get();
        $books->transform(function ($book) {
            $filename = basename($book->cover_path);
            $book->cover_path = 'storage/books/covers/' . $filename;
            return $book;
        });

        $pdf = Pdf::loadView('exports.pdf.books-table', compact('books'));

        return $pdf->download('buku-saya.pdf');
    }
}
