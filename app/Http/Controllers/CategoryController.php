<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $title = 'Daftar Kategori';
        $categories = Category::withCount('books')->get();
        return view('dashboard.categories.index', compact('title', 'categories'));
    }
}
