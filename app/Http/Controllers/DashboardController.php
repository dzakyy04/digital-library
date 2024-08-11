<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $totalMyBooks = Book::where('user_id', Auth::user()->id)->count();

        $data = compact('title', 'totalMyBooks');

        if (Gate::allows('admin-access')) {
            $totalAllBooks = Book::count();
            $totalCategories = Category::count();
            $data = array_merge($data, compact('totalAllBooks', 'totalCategories'));
        }

        return view('dashboard.index', $data);
    }
}
