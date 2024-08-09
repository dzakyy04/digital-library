<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $title = 'Daftar Kategori';
        return view('dashboard.categories.index', compact('title'));
    }
}
