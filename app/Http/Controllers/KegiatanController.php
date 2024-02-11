<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data =  Kegiatan::latest()->paginate(10)->withQueryString();

        return view('kegiatan.index', [
            'title' => 'Kegiatan Warga',
            'kegiatans' => $data
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
            'image' => 'required',
            'judul' => 'required',
            'ulasan' => 'required',
            'tanggal_kegiatan' => 'required'
        ]);

        if($request->file('image')){
            $path = $request->file('image')->store('files');
            $validate['image'] = $path;
        }

        Kegiatan::create($validate);

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Berhasil membuat kegiatan warga'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kegiatan $kegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kegiatan $kegiatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $rules = [
            'judul' => 'required',
            'ulasan' => 'required',
            'tanggal_kegiatan' => 'required'
        ];

        if($request->file('image')){
            $rules['image'] = 'required';
        }

        $validate = $request->validate($rules);

        if($request->file('image')){
            $path = $request->file('image')->store('files');
            $validate['image'] = $path;

            Storage::delete($kegiatan->image);
        }

        $kegiatan->update($validate);

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Berhasil merubah data kegiatan warga'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();

        Storage::delete($kegiatan->image);

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Berhasil menghapus data kegiatan warga'
        ]);
    }
}
