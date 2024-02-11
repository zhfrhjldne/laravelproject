<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;

class UserAspirasiController extends Controller
{
    public function index (Request $request) {
        $data = $request->id ? Aspirasi::where('id', $request->id)->latest()->paginate(10)->withQueryString() : Aspirasi::latest()->paginate(10)->withQueryString();
        $categories = Kategori::orderBy('nama')->get();

        return view('aspirasi.user.index', [
            'title' => 'Aspirasi',
            'aspirasis' => $data,
            'categories' => $categories
        ]);
    }
}
