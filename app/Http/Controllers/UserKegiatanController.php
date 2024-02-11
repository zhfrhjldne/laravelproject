<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class UserKegiatanController extends Controller
{
    public function index () {
        $data = Kegiatan::latest()->get();

        return view('kegiatan.user.index', [
            'title' => 'Kegiatan Warga',
            'kegiatans'=> $data
        ]);
    }
}
