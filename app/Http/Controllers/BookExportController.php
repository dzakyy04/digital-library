<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;

class BookExportController extends Controller
{
    public function exportMyBookPdf()
    {
        $userId = Auth::user()->id;
        $books = Book::where('user_id', $userId)->with('category')->get();
        $books->transform(function ($book) {
            $filename = basename($book->cover_path);
            $book->cover_path = 'storage/books/covers/' . $filename;
            return $book;
        });

        $pdf = Pdf::loadView('exports.pdf.books', compact('books'));

        return $pdf->download('buku-saya.pdf');
    }

    public function exportMyBookPdfTable()
    {
        $userId = Auth::user()->id;
        $books = Book::where('user_id', $userId)->with('category')->get();
        $books->transform(function ($book) {
            $filename = basename($book->cover_path);
            $book->cover_path = 'storage/books/covers/' . $filename;
            return $book;
        });

        $pdf = Pdf::loadView('exports.pdf.books-table', compact('books'));

        return $pdf->download('buku-saya.pdf');
    }

    public function exportMyBookExcel()
    {
        $userId = Auth::user()->id;
        $books = Book::where('user_id', $userId)->with('category')->get();

        $data = $books->map(function ($book, $index) {
            return [
                'No' => $index + 1,
                'Judul' => $book->title,
                'Kategori' => $book->category ? $book->category->name : null,
                'Deskripsi' => $book->description,
                'Jumlah' => $book->quantity,
                'Cover' => $book->cover_path ? '=HYPERLINK("' . $book->cover_path . '","Lihat Cover")' : null,
                'File' => $book->file_path ? '=HYPERLINK("' . $book->file_path . '","Unduh File")' : null,
            ];
        });

        return (new FastExcel($data))->download('buku-saya.xlsx');
    }
}
