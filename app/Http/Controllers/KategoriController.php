<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class KategoriController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        // Mendapatkan data kategori
        $kategoris = Kategori::all();

        // Render view dengan kategoris
        return view('kategoris.index', compact('kategoris'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('kategoris.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate form
        $this->validate($request, [
            'nama_kategori' => 'required|string|max:255'
        ]);

        // Create kategori
        Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        // Redirect to index
        return redirect()->route('kategoris.index')->with(['success' => 'Kategori berhasil disimpan!']);
    }

    /**
     * show
     *
     * @param  int  $id
     * @return View
     */
    public function show(int $id): View
    {
        // Mendapatkan data kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id);

        // Render view dengan kategori
        return view('kategoris.show', compact('kategori'));
    }

    /**
     * edit
     *
     * @param  int  $id
     * @return View
     */
    public function edit(int $id): View
    {
        // Mendapatkan data kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id);

        // Render view dengan kategori
        return view('kategoris.edit', compact('kategori'));
    }

    /**
     * update
     *
     * @param  Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        // Validate form
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        // Update kategori
        Kategori::findOrFail($id)->update($validatedData);

        // Redirect to index
        return redirect()->route('kategoris.index')->with(['success' => 'Kategori berhasil diperbarui!']);
    }

    /**
     * destroy
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        // Hapus kategori
        Kategori::findOrFail($id)->delete();

        // Redirect to index
        return redirect()->route('kategoris.index')->with(['success' => 'Kategori berhasil dihapus!']);
    }
}
