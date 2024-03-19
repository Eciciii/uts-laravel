<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        // Mendapatkan data barang bersama dengan data kategori yang terkait
        $barangs = Barang::with('kategori')->get();

        // Render view dengan barangs
        return view('barangs.index', compact('barangs'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        // Mendapatkan daftar kategori
        $kategoris = Kategori::all();

        // Render view dengan daftar kategori
        return view('barangs.create', compact('kategoris'));
    }

    /**
     * store
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate form
        $validatedData = $request->validate([
            'jumlah' => 'required|integer',
            'keterangan' => 'required|string',
            'harga_barang' => 'required|numeric',
            'id_kategori' => 'required|exists:kategoris,id',
        ]);

        // Buat barang baru
        Barang::create($validatedData);

        // Redirect to index
        return redirect()->route('barangs.index')->with(['success' => 'Barang berhasil disimpan!']);
    }

    /**
    * show
    *
    * @param  mixed $id
    * @return View
    */
    public function show(string $id): View
    {
    // Get barang by ID
    $barang = Barang::findOrFail($id);

    // Render view with barang
    return view('barangs.show', compact('barang'));
    }

    /**
     * edit
     *
     * @param  string  $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get barang by ID
        $barang = Barang::findOrFail($id);

        // Mendapatkan daftar kategori
        $kategoris = Kategori::all();

        // Render view dengan data barang dan daftar kategori
        return view('barangs.edit', compact('barang', 'kategoris'));
    }

    /**
    * update
    *
    * @param  Request  $request
    * @param  string  $id
    * @return RedirectResponse
    */
    public function update(Request $request, string $id): RedirectResponse
    {
    // Validate form
    $validatedData = $request->validate([
        'jumlah' => 'required|integer',
        'keterangan' => 'required|string',
        'harga_barang' => 'required|numeric',
        'id_kategori' => 'required|exists:kategoris,id',
    ]);

    // Get barang by ID
    $barang = Barang::findOrFail($id);

    // Update barang
    $barang->update($validatedData);

    // Redirect to index
    return redirect()->route('barangs.index')->with(['success' => 'Barang berhasil diupdate!']);
    }

    /**
     * destroy
     *
     * @param  string  $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        //get barang by ID
        $barang = Barang::findOrFail($id);

        // Hapus barang
        $barang->delete();

        // Redirect to index
        return redirect()->route('barangs.index')->with(['success' => 'Barang berhasil dihapus!']);
    }
}
