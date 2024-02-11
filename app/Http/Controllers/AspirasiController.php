<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AspirasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Aspirasi::latest();
    
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->input('start_date'));
        }
    
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->input('end_date'));
        }
    
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->input('kategori'));
        }
    
        $data = $query->paginate(10)->withQueryString();
    
        $categories = Kategori::orderBy('nama')->get(); // Fetching categories
    
        return view('aspirasi.index', [
            'title' => 'Aspirasi',
            'aspirasis' => $data,
            'categories' => $categories, // Passing categories to the view
            'request' => $request,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama' => 'required',
            'image' => 'required',
            'kategori_id' => 'required',
            'isi' => 'required',
            'alamat' => 'required',
        ]);

        $validate['status'] = 'Pending';

        if($request->file('image')){
            $path = $request->file('image')->store('files');
            $validate['image'] = $path;
        }

        Aspirasi::create($validate);

        return back()->with('alert', [
            'type' =>  'success',
            'message' => 'Berhasil membuat aspirasi warga'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Aspirasi $aspirasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aspirasi $aspirasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aspirasi $aspirasi)
    {
        $validate = $request->validate([
            'feedback' => 'required'
        ]);

        if($aspirasi->status == 'Pending') {
            $validate['status'] = 'Diproses';
        } else if($aspirasi->status == 'Diproses'){
            $validate['status'] = 'Selesai';
        }

        $aspirasi->update($validate);

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Berhasil melakukan umpan balik aspirasi ' . $aspirasi->nama
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aspirasi $aspirasi)
    {
        //
    }
}
