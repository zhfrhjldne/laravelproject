<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'title' => 'Dashboard',
            'total_aspirasi' => Aspirasi::count(),
            'total_kegiatan' => Kegiatan::count()
        ]);
    }
}
