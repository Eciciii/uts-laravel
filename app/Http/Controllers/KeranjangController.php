<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KeranjangController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        $keranjangs = Keranjang::latest()->paginate(5);
        return view('keranjangs.index', compact('keranjangs'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('keranjangs.create');
    }

    /**
     * store
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'id_pengguna' => 'required',
            'id_barang' => 'required',
            'qty' => 'required'
        ]);

        Keranjang::create($request->all());

        return redirect()->route('keranjangs.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  int  $id
     * @return View
     */
    public function show(int $id): View
    {
        $keranjang = Keranjang::findOrFail($id);
        return view('keranjangs.show', compact('keranjang'));
    }

    // Implement methods for edit and update if needed
    /**
     * edit
     *
     * @param  int  $id
     * @return View
     */
    public function edit(int $id): View
    {
        $keranjang = Keranjang::findOrFail($id);
        return view('keranjangs.edit', compact('keranjang'));
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
        $this->validate($request, [
            'id_pengguna' => 'required',
            'id_barang' => 'required',
            'qty' => 'required'
        ]);

        $keranjang = Keranjang::findOrFail($id);
        $keranjang->update($request->all());

        return redirect()->route('keranjangs.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    
    /**
     * destroy
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $keranjang = Keranjang::findOrFail($id);
        $keranjang->delete();
        return redirect()->route('keranjangs.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
