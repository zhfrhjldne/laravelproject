<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kategori::latest()->paginate(10)->withQueryString();

        return view('kategori.index', [
            'title' => 'Kategori Aspirasi',
            'kategoris' => $data
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
        $validate  = $request->validate([
            'nama' => 'required'
        ]);

        Kategori::create($validate);

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Berhasil membuat kategori'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validate = $request->validate([
            'nama' => 'required'
        ]);

        $kategori->update($validate);

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Berhasil merubah kategori ' . $kategori->name
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Berhasil menghapus kategori ' . $kategori->name
        ]);
    }
}
