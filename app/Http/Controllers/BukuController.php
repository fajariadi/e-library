<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\DataTables\BukusDataTable;
use App\Http\Requests\BukuRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BukusDataTable $dataTables)
    {
        return $dataTables->render('buku.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buku.form', ['buku' => new Buku()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BukuRequest $request)
    {
        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->author = $request->author;
        $buku->genre = $request->genre;
        if ($request->hasFile('gambar')) {
            $buku->gambar = $request->file('gambar')->getClientOriginalName();
        }
        $buku->harga = $request->harga;
        $buku->jumlah_halaman = $request->jumlah_halaman;
        $buku->jumlah_buku = $request->jumlah_buku;

        if($buku->save()){
            $photo = $request->file('gambar');
            $photo->storeAs('sampul', $photo->getClientOriginalName(), ['disk' => 'public']);
        }
        
        return response()->json([
            'status' => 'success',
            'message' => 'Create Data successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit(Buku $buku)
    {
        return view('buku.form', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(BukuRequest $request, Buku $buku)
    {
        $buku->judul = $request->judul;
        $buku->author = $request->author;
        $buku->genre = $request->genre;
        $buku->gambar = $request->gambar;
        $buku->harga = $request->harga;
        $buku->jumlah_halaman = $request->jumlah_halaman;
        $buku->jumlah_buku = $request->jumlah_buku;
        if($buku->save()){
            $photo = $request->file('gambar');
            $photo->storeAs('sampul', $photo->getClientOriginalName(), ['disk' => 'public']);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Update data successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buku $buku)
    {
        Storage::disk('public')->delete('sampul/'.$buku->gambar);
        $buku->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Delete data successfully'
        ]);
    }
}
