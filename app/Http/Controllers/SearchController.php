<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = Course::with('category');

        // Filter berdasarkan kata kunci pencarian, jika ada
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        // Ambil data course beserta kategori
        $courses = $query->get();

        // Kirimkan data ke view atau response sebagai JSON
        return response()->json($courses);
    }

}