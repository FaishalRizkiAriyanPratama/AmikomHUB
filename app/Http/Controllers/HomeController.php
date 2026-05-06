<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil semua jenis kategori
        $categories = Category::all();

        // 2. Query event
        $query = Event::with('category')
            ->where('date', '>=', now())
            ->orderBy('date', 'asc');

        // 3. Filter berdasarkan kategori (jika ada)
        if ($request->has('category') && $request->category != '') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // 4. Ambil data event
        $events = $query->get();

        // 5. Kirim ke view
        return view('welcome', compact('events', 'categories'));
    }
}